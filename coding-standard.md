# PHP Coding standard

PHP Coding standard for wordpress plugin development

## Naming Conventions

Using lowercase letters in **variable**, **action/filter**, and **function names** (never camelcase). Separate words via underscores. Don't abbreviate variable names unnecessarily. Let the code be unambiguous and self-documenting.

```php
    function some_name( $some_variable ) { [...] }
```

**Class** names should use capitalized words separated by underscores. Any acronyms should be all upper case.

```php
    class Walker_Category extends Walker { [...] }
    class WP_HTTP { [...] }
```

**Constants** should be in all upper-case with underscores separating words:

```php
    define( 'DOING_AJAX', true );
```

**Files** should be named descriptively using lowercase letters. Hypens should separate words.

```php
    my-plugin-name.php
```
