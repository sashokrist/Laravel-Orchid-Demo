<?php

namespace App\Orchid\Filters;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class TagFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Tag filter';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['tag'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        $tagName = Tag::find($this->request->get('tag'));
        return $builder->whereHas('tags', function (Builder $query) use ($tagName) {
            $query->where('name', $tagName->name);
        });
        // return $builder->withTags();
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('tag')
                ->fromModel(Tag::class, 'name')
                ->empty('Select Tag: ' . $this->request->get('tag'))
                ->title(__('Tag')),
        ];
    }
}
