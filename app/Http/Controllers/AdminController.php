<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Helper method untuk cek admin
    private function checkAdmin()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/products')->with('error', 'Access denied. Admin only.');
        }
        return null;
    }

    public function dashboard()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;

        // Statistics
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');

        // Order statistics
        $pendingOrders = Order::pending()->count();
        $processingOrders = Order::processing()->count();
        $shippedOrders = Order::shipped()->count();

        // Monthly sales data for chart
        $monthlySales = $this->getMonthlySalesData();
        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();


        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalProducts', 
            'totalOrders', 
            'totalRevenue',
            'pendingOrders',
            'processingOrders',
            'shippedOrders',
            'monthlySales',
            'recentUsers',
            'recentOrders'
        ));
    }

    public function users()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function products()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:100'
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    public function editProduct($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:100'
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    public function deleteUser($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    public function orders()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $orders = Order::with(['user', 'orderItems.product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function orderDetail($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.detail', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck) return $adminCheck;
        
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'tracking_number' => 'nullable|string|max:100'
        ]);

        $order->update([
            'status' => $request->status,
            'tracking_number' => $request->tracking_number
        ]);

        if ($request->status === 'shipped') {
            $order->markAsShipped($request->tracking_number);
        } elseif ($request->status === 'delivered') {
            $order->markAsDelivered();
        }

        return back()->with('success', 'Order status updated successfully!');
    }

    private function getMonthlySalesData()
    {
        // Sample data untuk demo
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => [65, 59, 80, 81, 56, 55, 40, 70, 90, 85, 75, 95],
            'revenue' => [1200, 1900, 3000, 2500, 2200, 3000, 2800, 3500, 4000, 3800, 3200, 4500]
        ];
    }
}