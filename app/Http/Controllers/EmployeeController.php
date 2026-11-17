<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\OrderService;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\Order;
use App\Http\Controllers\AdminController;

class EmployeeController extends Controller
{
    public function dashboard(){
        $user_id=auth()->user()->user_id;
        $orders_received_today=Order::with('items')->where('created_by',$user_id)
                                ->whereDate('created_at',today())->count();
        $order_ready=Order::with('items')->where('created_by',$user_id)
                            ->where('processing_status','ready_for_pickup')->latest()
                            ->paginate(5, ['*'], 'ready_page');

        $processing_order=Order::with('items')->where('created_by',$user_id)
                                ->where('processing_status','washed')->latest()
                                ->paginate(5, ['*'], 'processing_page');

        $orders=Order::with('items')->where('created_by',$user_id)->latest()
                                    ->paginate(10, ['*'], 'orders_page');

        $unpaid_orders=Order::with('items')->where('created_by',$user_id)
                            ->where('payment_status','unpaid')->latest()
                            ->paginate(5, ['*'], 'unpaid_page');
        
        return view('employee.dashboard',compact(['orders_received_today','order_ready','processing_order','orders','unpaid_orders']));
    }

    public function showOrders(){
        $items=Item::with('category')->get();
        $orders=Order::with('items')->latest()->paginate(10);

        return view('employee.orders',compact(['items','orders']));
    }

   
    public function storeOrders(Request $request){
        $validated = $request->validate([
            'pickup_date' => ['required', 'date'],
            'client_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['required', 'string', 'max:255'],
            'payment_status' => ['nullable', 'in:paid,unpaid'],
            'processing_status' => ['required', 'in:Not_washed,Washed,Ironed,Ready_for_pickup,Collected'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_id' => ['required', 'integer', 'exists:items,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'integer', 'min:0'],
        ]);

        try {
            $order = $this->orderService->createOrderWithItems(
                validated: $validated,
                createdBy: Auth::id(),
            );

            return back()
                ->withInput()
                ->with('success', "Order #{$order->order_number} created successfully!");
        } catch (Throwable $e) {
            Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create the order. Please try again.');
        }


    }

    public function updateOrder(){
        $request->validate(
            [
                
                'payment_status' => 'required|in:paid,unpaid',
                'processing_status' => ['required', 'in:Not_washed,Washed,Ironed,Ready_for_pickup,Collected'],

            ]
        );

        $userService=new OrderService();

        try{
            $userService->updateUser(
            $user,
           [
           
            $request->payment_status,
            $request->processing_status,

            ]
        );
        
            return back()
                ->withInput()
                ->with('success',"Order updated successfully");

        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('Order update failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to update order. Please try again.'. $e->getMessage());
        }
    }

    public function deleteOrder(){

    }

    public function editUser(Request $request){
        $request->validate(
            [
                'name'=>['required','string','max:255'],
                'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
                ],
                'role' => 'required|in:admin,employee',
                'status' => 'required|in:active,inactive',
                'password' => $this->passwordRules(),

            ]
        );

        $userService=new UserService();
        $user=auth()->user()->user_id;
        try{
            $userService->updateUser(
            $user,
           [
            $request->name,
            $request->status,
            $request->role,
            $request->email,
            $request->password,

            ]
        );
        
            return back()
                ->withInput()
                ->with('success',"User updated successfully");

        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('User update failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to update user. Please try again.'. $e->getMessage());
        }

    }

    public function deleteUser(){
        
        $user=auth()->user();
        $userService=new UserService;
        try{
            $userService->deleteUser($user);
            return back()
                ->withInput()
                ->with('success', 'User deleted successfully');

        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('User deletion failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to delete user. Please try again.'. $e->getMessage());
        }
    }

    public function payments(){

        return view('employee.payments');
    }

    public function settings(){
        return view('employee.settings');
    }
    public function pay(){
        
    }

}
