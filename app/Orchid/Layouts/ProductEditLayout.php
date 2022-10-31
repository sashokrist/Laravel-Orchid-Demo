<?php

namespace App\Orchid\Layouts;

use App\Models\Category;
use App\Models\Product;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class ProductEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
       // $isProductExist = is_null($this->query->getContent('product')) === false;
        return [
            Input::make('product.id')->type('hidden'),
            Input::make('product.title')->required()->title('Title'),
            Input::make('product.description')->required()->title('Description'),
            Relation::make('product.categories')
                ->fromModel(Category::class, 'title')
                ->title('Category'),
            Input::make('product.price')
                ->title('Price')
                ->mask([
                    'alias' => 'currency',
                    'prefix' => '£',
                    'groupSeparator' => ' ',
                    'digitsOptional' => true,
                ]),

        Picture::make('product.image')->required()->title('Image'),
        ];
    }
}
