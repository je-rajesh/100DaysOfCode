# LearningDay 37, 03/04/21. 

## today i learnt about following things.

#### how to wipe entire database using artisan command
```bash
php artisan db:wipe
```

#### how to access env variables in node.js runtime environment. 
```javascript
const environment = PROCESS.env.NODE_ENV
```

#### how to delete all entries for a model in database (Laravel 8)
```php
Application::truncate()->get() // application is just a model
```

#### This one is a bit of warning-- 
**never put null as a column value when you are column is string but nullable**
- imagine a scenario about you are making a column a string column but nullable (means it can be null).
- problem is not in storing null value but in retrieving it. 
- suppose you are fetching these data as json in your single page application. 
- since null is stored at its place.
- when it will be converted in json. it will become 'null' string. so your column will not be empty. 
- instead **store as empty string**. 

#### This one is about form data validation in laravel
- suppose there is a scenario that you want the user to use method of identification. 
- user  should either choose aadhar card or pan card id for identification
- so when the user will choose aadhar card then he should enter aadhar card number, his date of birth and his virtual id. 
- when the user chooses pan card details then he should enter pan card id, fathers name, so form validation will look like this in Laravel 
```php
[
    'identification_method' =>  ['required', Rule::in(['aadhar_card', 'pan_card'])],

    'aadhar_card_id' => ['required_if:identification_method,aadhar_card', 'string', 'nullable'],
    'date_of_birth' => ['required_if:identification_method,aadhar_card', 'string', 'nullable'],
    'virtual_id' => ['required_if:identification_method,aadhar_card', 'string', 'nullable'],

    'pan_card_id' => ['required_if:identification_method,pan_card', 'string', 'nullable'],
    'fathers_name' => ['required_if:identification_method,pan_card', 'string', 'nullable'],
]
```

#### Validating That inputs are not following values. 
```php
    'name_first_letter' => [Rule::notIn(['a', 'c', 'd']), ]
```
