<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductEditLayout;
use Illuminate\Http\Request;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ProductEditScreen extends Screen
{
    /**
     * @var Product
     */
    public $product;

    /**
     * Query data.
     *
     * @param Product $product
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
        return 'Product Edit Screen';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Edit product: '. $this->product->title;
    }

    /**
     * @return iterable|null
     */
//    public function permission(): ?iterable
//    {
//        return [
//            'platform.products.update',
//        ];
//    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),

//            Button::make(__('Remove'))
//                ->icon('trash')
//                ->method('remove')
//                ->canSee($this->role->exists),
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
            ProductEditLayout::class,
        ];

    }

    /**
     * @param Request $request
     * @param Role    $role
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Product $product)
    {
       // dd($request->all());
        $request->validate([
            'product.title' => [ 'required'],
            'product.description' => [ 'required'],
            'product.price' => [ 'required'],
        ]);

        $product->fill($request->input('product'))->save();

        Toast::info(__('Product was saved.'));

        return redirect()->route('platform.products');
    }
}
