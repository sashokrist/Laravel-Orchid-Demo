<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
use App\Models\Tag;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

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

            Relation::make('product.categories.')
                ->fromModel(Category::class, 'title')
                ->multiple()
                ->title('Category'),

            Relation::make('product.tags')
                ->fromModel(Tag::class, 'name')
                ->title('Tag'),

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
