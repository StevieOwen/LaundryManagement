<?php

namespace App\Services;
use App\Models\Order;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\User;

class OrderService{

    public function createOrderWithItems(array $validated, int $createdBy): Order
    {
        return DB::transaction(function () use ($validated, $createdBy) {
            $items = $validated['items'];

            $totalPrice = collect($items)->sum(
                fn (array $item) => $item['quantity'] * $item['unit_price']
            );

            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'created_by' => $createdBy,
                'pickup_date' => $validated['pickup_date'],
                'client_name' => $validated['client_name'],
                'client_phone' => $validated['client_phone'],
                'total_price' => $totalPrice,
                'payment_status' => $validated['payment_status'] ?? 'unpaid',
                'processing_status' => $validated['processing_status'],
            ]);

            foreach ($items as $item) {
                $quantity = (int) $item['quantity'];
                $unitPrice = (int) $item['unit_price'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => (int) $item['item_id'],
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $quantity * $unitPrice,
                ]);
            }

            return $order;
        });
    }

    private function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }

    public function updateOrder(Order $order, array $array){
        // Define the fields you want to allow for modification
        $allowedFields = ['payment_status','processing_status'];

        // Filter the incoming array to only include allowed keys, then update & save
        $user->update(array_intersect_key($data, array_flip($allowedFields)));

        return $order;
    }

    public function deleteOrder(Order $order){
        $order->delete();
    }

}