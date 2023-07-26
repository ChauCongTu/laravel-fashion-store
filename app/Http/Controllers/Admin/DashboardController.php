<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // statistics
        $stats = [
            'guests' => User::where('role', 'user')->count(),
            'productSold' => intval(OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.payment_status', '=', 'Đã thanh toán')
                ->sum('quantity')),
            'orders' => Order::count(),
            'totalEarning' => intval(Order::where('payment_status', 'Đã thanh toán')->sum('total'))
        ];

        // Revenue statistics
        if ($request->startDate != null && $request->endDate != null) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
        } else {
            $startDate = date('Y-m-d', strtotime('-7 days'));
            $endDate = date('Y-m-d');
        }

        $daysDiff = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24);
        $weeksDiff = floor($daysDiff / 7);
        $monthsDiff = floor($daysDiff / 30);
        $timeRevenue = [];
        $valueRevenue = [];
        if ($daysDiff < 10) {
            $revenue = Order::select(DB::raw('DATE(created_at) as time'), DB::raw('SUM(orders.total) as revenue'))
                ->where('payment_status', 'Đã thanh toán')
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->get();
            foreach ($revenue as $item) {
                $timeRevenue[] = 'Ngày ' . date('d/m', strtotime($item->time));
                $valueRevenue[] = $item->revenue;
            }
        } else if ($daysDiff >= 10 && $daysDiff <= 56) {
            $revenue = Order::select(DB::raw('WEEK(created_at) as time'), DB::raw('SUM(orders.total) as revenue'))
                ->where('payment_status', 'Đã thanh toán')
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->groupBy(DB::raw('WEEK(created_at)'))
                ->get();
            foreach ($revenue as $item) {
                $timeRevenue[] = 'Tuần ' . $item->time;
                $valueRevenue[] = $item->revenue;
            }
        } else {
            $revenue = Order::select(DB::raw('MONTH(created_at) as time'), DB::raw('SUM(orders.total) as revenue'))
                ->where('payment_status', 'Đã thanh toán')
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();
            foreach ($revenue as $item) {
                $timeRevenue[] = 'Tháng ' . $item->time;
                $valueRevenue[] = $item->revenue;
            }
        }

        // Top customers who buy the most
        $topCustomers = User::join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.name', 'users.email', DB::raw('SUM(total) as price'), DB::raw('COUNT(orders.id) as numbOrder'))
            ->where('orders.payment_status', '=', 'Đã thanh toán')
            ->groupBy('orders.user_id')
            ->orderBy('price', 'DESC')
            ->limit(6)
            ->get();

        // Order status
        $orderStatus = [];
        $orderStatus[] = Order::where('status', 'Đang xử lý')->count();
        $orderStatus[] = Order::where('status', 'Đang giao hàng')->count();
        $orderStatus[] = Order::where('status', 'Chờ lấy hàng')->count();
        $orderStatus[] = Order::where('status', 'Hoàn thành')->count();
        $orderStatus[] = Order::where('status', 'Đã hủy')->count();

        // Top product seller
        $hotProduct = [];
        $topProducts = OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.name as product', DB::raw('COUNT(products.id) as quantity'))
            ->groupBy('order_details.product_id')
            ->orderBy('quantity', 'desc')
            ->limit(6)
            ->get();
        foreach ($topProducts as $item) {
            $hotProduct['product'][] = $item->product;
            $hotProduct['quantity'][] = $item->quantity;
        }
        // dd($hotProduct);
        return view('admin.dashboard', compact('stats', 'revenue', 'timeRevenue', 'valueRevenue', 'topCustomers', 'orderStatus', 'hotProduct'));
    }
}
