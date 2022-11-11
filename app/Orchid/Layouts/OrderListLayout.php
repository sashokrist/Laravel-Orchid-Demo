<?php

namespace App\Orchid\Layouts;

use App\Models\Order;
use App\Orchid\Layouts\Product\ProductFilterLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'data';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('details', 'Details')->width('50px')->cantHide()->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Order $order){
                    return Link::make($order->details);
                      //  ->route('platform.products.show', $order)->icon('eye');
                }),
            TD::make('client', 'Client')->width('100px')->cantHide()->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Order $order){
                    return $order->client;
                    //  ->route('platform.products.show', $order)->icon('eye');
                }),
//            TD::make('price', 'Price')->width('100px')->cantHide()->filter(TD::FILTER_TEXT)->sort(),
//            TD::make('image', 'Image')->width('100px')->cantHide()
//                ->render(function (Product $product) {
//                    $product->attachment()->get();
//                    return view('products.image', ['image' => $product->image]);
//                }),
//            TD::make('category', 'category')->width('100px')->cantHide()->filter(ProductFilterLayout::class)->sort()
//                ->render(function (Product $product){
//                    return join(', ' , $product->categories->pluck('title')->all());
//                }),
//            TD::make('tag', 'tag')->width('100px')->cantHide()->filter(TD::FILTER_TEXT)->sort()
//                ->render(function (Product $product){
//                    return $product->tags->name;
//                }),
//            TD::make(__('Actions'))
//                ->align(TD::ALIGN_CENTER)
//                ->width('100px')
//                ->render(function (Product $product) {
//                    return DropDown::make()
//                        ->icon('options-vertical')
//                        ->list([
//                            Link::make(__('Edit'))
//                                ->route('platform.products.edit', $product->id)
//                                ->icon('pencil'),
//                            Button::make(__('Delete'))
//                                ->icon('trash')
//                                ->confirm(__('Once is deleted, all of its resources and data will be permanently deleted.'))
//                                ->method('remove', [
//                                    'id' => $product->id,
//                                ]),
//                        ]);
//                }),
        ];
    }
}
