<?php

namespace App\Services\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

abstract class BaseDTO
{
    public function __construct()
    {
        $this->build(func_get_args());

        $validator = $this->getValidator();
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function toArray(): array
    {
        return (array) $this;
    }

    protected function rules(): array
    {
        return [];
    }

    protected function messages(): array
    {
        return [];
    }

    protected function extendRequestProps(Request $request): void
    {
        // to be implemented by child if needed
    }

    protected function extendArrayProps(array $array): void
    {
        // to be implemented by child if needed
    }

    private function getValidator(): Validator
    {
        return ValidatorFacade::make($this->toArray(), $this->rules(), $this->messages());
    }

    private function build(array $args): void
    {
        if ($args[0] instanceof Request) {
            $request = $args[0];
            $this->mapToProperties($request->all());
            $this->extendRequestProps($request);
        } else if (is_array($args[0])) {
            $array = $args[0];
            $this->mapToProperties($array);
            $this->extendArrayProps($array);
        }
    }

    private function mapToProperties(array $array): void
    {
        foreach ($array as $key => $value) {
            if (!isset($this->{$key})) {
                $this->{$key} = $value;
            }
        }
    }
}
