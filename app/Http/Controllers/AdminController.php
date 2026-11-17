<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Actions\Fortify\PasswordValidationRules;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\ItemService;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;


class AdminController extends Controller
{
    public function dashboard(){
        $total_orders=Order::count();
        $order_ready=Order::where('processing_status','Ready_for_pickup')->count();
        $unpaid_orders=Order::where('payment_status','unpaid')->count();
        $paid_orders=Order::where('payment_status','paid')->count();
        $orders=Order::with('items')->latest()->take(8)->get();
        $revenue=Order::where('payment_status','paid')->sum('total_price');
        $outstanding_payment=Order::where('payment_status','unpaid')->sum('total_price');

        return view('admin.dashboard',compact(['total_orders','order_ready','unpaid_orders','paid_orders','orders','revenue','outstanding_payment']));
    }
    // User
    public function users(){
        $users=User::latest()->paginate(10);
        return view('admin.users',compact('users'));
    }

    public function storeUser(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'status'=>'required|in:active,inactive',
            'role'=>'required|in:admin,employee',
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $user_id=\Illuminate\Support\Str::uuid();

        $userService=new UserService();

        try{
            $userService->createUser(
                [
                    $user_id,
                    $request->name,
                    $request->email,
                    $request->status,
                    $request->role,
                    $request->password,

                ]
            );
            return back()
            ->withInput()
            ->with('success','New user added successfully');
        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('User creation failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
            ->withInput()
            ->with('error', 'Failed to create the new user. Please try again.'. $e->getMessage());
        };

    }

    public function updateUser(Request $request, User $user){
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

        if (filled($validated['password'] ?? null)) {
        $reuqest->password = Hash::make($validated['password']);
        } else {
            unset($request->password);
        }

        $userService=new UserService();

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

    public function deleteUser(User $user){
        $userService=new UserService();
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

    // Category

    public function categories(){
        $categories = Category::latest()->paginate(10);
        return view('admin.categories',compact('categories'));
    }

    public function storeCategories(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description'=>['required','string','max:255'],
        ]);

        $categoryService=new CategoryService();

        try{
            $categoryService->storeCategory(
                [
                    $request->name,
                    $request->description,
                ]
            );
            return back()
            ->withInput()
            ->with('success','New category added successfully');
        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('Category creation failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
            ->withInput()
            ->with('error', 'Failed to create the new category. Please try again.'. $e->getMessage());
        };
    }

    public function updateCategory(Request $request, Category $category){
        $request->validate(
            [
                'name'=>['string','max:255'],
                'description'=>['string','max:255'],
            ]
        );

        $categoryService=new CategoryService();

        try{
            $categoryService->updateCategory(
            $category,
            [
                $request->name,
                $request->description,
            ]
            );
        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('Category update failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
            ->withInput()
            ->with('error', 'Failed to update the new category. Please try again.'. $e->getMessage());   
        }

        
    }

    public function deleteCategory(Category $category){
        $categoryService=new CategoryService();

        try{
            $categoryService->deleteCategory($category);
            return back()
                ->withInput()
                ->with('success', 'Category deleted successfully');

        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('Category deletion failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to delete category. Please try again.'. $e->getMessage());
        }
    }

    //items

    public function items(){
        $items=Item::with('category')->latest()->paginate(10);
        $categories=Category::orderby('name')->get();

        return view('admin.items',compact(['items','categories']));
    }

    public function storeItems(Request $request){
        $request->validate([
            'designation'=>['required','string','max:255'],
            'category_id'=>'required|exists:users,user_id',
        ]);

        $itemService=new ItemService();

        try{
            $itemService->storeCategory(
                [
                    $request->designation,
                    $request->category_id,
                ]
            );
            return back()
            ->withInput()
            ->with('success','New item added successfully');
        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('Item creation failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
            ->withInput()
            ->with('error', 'Failed to create the new item. Please try again.'. $e->getMessage());
        };
    }

    public function updateItem(Request $request, Item $item){
        $request->validate(
            [
                'designation'=>['string','max:255'],
                'category_id'=>'required|exists:users,user_id',
            ]
        );

        $itemService=new ItemService();

        try{
            $itemService->updateItem(
            $item,
            [
                $request->designation,
                $request->category_id,
            ]
            );
        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('item update failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
            ->withInput()
            ->with('error', 'Failed to update the new item. Please try again.'. $e->getMessage());   
        }

        
    }

    public function deleteItem(Item $item){
        $itemService=new ItemService();

        try{
            $itemService->deleteItem($item);
            return back()
                ->withInput()
                ->with('success', 'Item deleted successfully');

        }catch(\Exception $e){
            // Log actual error for debugging
            Log::error('Item deletion failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to delete item. Please try again.'. $e->getMessage());
        }
    }

    public function settings(){
        $user=auth()->user();
        return view('admin.settings',compact('user'));
    }

    
    

}
