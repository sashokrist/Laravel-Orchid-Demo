<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class ProductShowScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            'product' => $product
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ProductShowScreen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Back')->route('platform.products')->icon('arrow-left-circle')
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
            Layout::modal('showProduct', Layout::legend('product', [
                Sight::make('id'),
                Sight::make('title'),
                Sight::make('description'),
                Sight::make('price'),
                Sight::make('image'),
            ]))
                ->title('Show Product')
                ->withoutApplyButton()
                ->open(),
            Layout::legend('product', [
                Sight::make('id'),
                Sight::make('title'),
                Sight::make('description'),
                Sight::make('price'),
                Sight::make('image'),
            ]),
        ];
    }
}
