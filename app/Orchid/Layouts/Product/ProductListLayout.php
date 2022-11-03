<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title')->width('150px')->cantHide()->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Product $product){
                    return Link::make($product->title)
                        ->route('platform.products.show', $product->id)->icon('eye');
                }),
            TD::make('description', 'Description')->width('100px')->cantHide(),
            TD::make('price', 'Price')->width('100px')->cantHide()->filter(TD::FILTER_TEXT)->sort(),
            TD::make('image', 'Image')->width('100px')->cantHide(),
            TD::make('category', 'category')->width('100px')->cantHide()->filter(ProductFilterLayout::class)->sort()
            ->render(function (Product $product){
                return join(', ' , $product->categories->pluck('title')->all());
            }),
            TD::make('tag', 'tag')->width('100px')->cantHide()->filter(TD::FILTER_TEXT)->sort()
                ->render(function (Product $product){
                    return Link::make($product->tags->name)
                        ->route('platform.products.filter', $product->tags->name)->icon('filter');
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Product $product) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.products.edit', $product->id)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once is deleted, all of its resources and data will be permanently deleted.'))
                                ->method('remove', [
                                    'id' => $product->id,
                                ]),
                        ]);
                }),
        ];
    }
}
