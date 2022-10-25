<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use App\Notifications\TaskCompleted;
use App\Orchid\Layouts\ProductEditLayout;
use App\Orchid\Layouts\ProductListLayout;
use App\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Components\Notification;
use Orchid\Platform\Models\Role;
use \App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductListScreen extends Screen
{
    use ProductTrait;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Product::filters()
                ->defaultSort('id', 'desc')
                ->paginate(5),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Products Screen';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All products. Total: (' . Product::all()->count() . ')';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.products.list',
        ];
    }


    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('title'),
            Sight::make('description'),
            Sight::make('price'),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Create Product')->modal('addProduct')->method('saveProduct'),
//            Link::make(__('Add'))
//                ->icon('plus')
//                ->route('platform.products.create'),
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
            ProductListLayout::class,
            Layout::modal('addProduct', ProductEditLayout::class)->async('asyncGetProduct'),
//            Layout::modal('asyncEditProductModal', ProductEditLayout::class)
//                ->async('asyncGetProduct'),
        ];
    }

    /**
     * @param Product $product
     *
     * @return array
     */
    public function asyncGetProduct(Product $product): iterable
    {
        return [
            'product' => $product,
        ];
    }

    /**
     * @param Request $request
     * @param Product    $product
     */
    public function saveProduct(Request $request, Product $product): void
    {
        $request->validate([
            'product.title' => [ 'required'],
            'product.description' => [ 'required'],
            'product.price' => [ 'required'],
        ]);

        $product->fill($request->input('product'))->save();

        $users = User::query()->get();
        foreach ($users as $user) {
            $user->byRoleCustomer()->notify(new TaskCompleted());
        }
        Toast::info(__('Product was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Product::findOrFail($request->get('id'))->delete();

        Toast::info(__('Product was removed'));
    }
}
