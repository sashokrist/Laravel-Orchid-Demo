<?php

namespace App\Orchid\Layouts;

use App\Models\Category;
use App\Models\Product;
use App\Orchid\Screens\ProductListScreen;
use Orchid\Platform\Models\Role;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Legend;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

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
            TD::make('description', 'Description')->width('150px')->cantHide(),
            TD::make('price', 'Price')->width('150px')->cantHide()->filter(TD::FILTER_TEXT)->sort(),
            TD::make('image', 'Image')->width('150px')->cantHide(),
            TD::make('category', 'category')->width('150px')->cantHide()
            ->render(function (Product $product){
               // dd($product->categories());
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
