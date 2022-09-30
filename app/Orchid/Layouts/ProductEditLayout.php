<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Upload;
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
            Input::make('product.price')->required()->title('Price'),
            Picture::make('product.image')->required()->title('Image'),
        ];
    }
}
