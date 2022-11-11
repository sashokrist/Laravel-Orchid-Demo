<?php

namespace App\Orchid\Screens\Order;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Orchid\Layouts\OrderListLayout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(OrderRepositoryInterface $orderRepository): iterable
    {
        $order = $orderRepository->getAllOrders();
       // $order = Order::filters()->defaultSort('id')->paginate(5);
        return [
            'data' =>  $order
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Order List Screen';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All orders";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('New Order')
                ->icon('paper-plane')
                ->method('store')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            OrderListLayout::class
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json(
            [
                'data' => $this->orderRepository->createOrder($orderDetails)
            ],
            ResponseAlias::HTTP_CREATED
        );
    }

//    public function show(Request $request): JsonResponse
//    {
//        $orderId = $request->route('id');
//
//        return response()->json([
//            'data' => $this->orderRepository->getOrderById($orderId)
//        ]);
//    }

    public function update(Request $request): JsonResponse
    {
        $orderId = $request->route('id');
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->orderRepository->updateOrder($orderId, $orderDetails)
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $orderId = $request->route('id');
        $this->orderRepository->deleteOrder($orderId);

        return response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
