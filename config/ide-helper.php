<?php

declare(strict_types=1);

return [
    "filename" => "_ide_helper.php",

    "models_filename" => "_ide_helper_models.php",

    "meta_filename" => ".phpstorm.meta.php",

    "include_fluent" => false,

    "include_factory_builders" => false,

    "write_model_magic_where" => false,

    "write_model_external_builder_methods" => false,

    "write_model_relation_count_properties" => false,

    "write_eloquent_model_mixins" => false,

    "include_helpers" => false,

    "helper_files" => [
        base_path() . "/vendor/laravel/framework/src/Illuminate/Support/helpers.php",
    ],

    "model_locations" => [
        "app",
        "src/Models",
    ],

    "ignored_models" => [
    ],

    "model_hooks" => [
    ],

    "extra" => [
    ],

    "magic" => [
    ],

    "interfaces" => [
    ],

    "custom_db_types" => [
    ],

    "model_camel_case_properties" => true,

    "type_overrides" => [
        "integer" => "int",
        "boolean" => "bool",
    ],

    "include_class_docblocks" => false,

    "force_fqn" => false,

    "additional_relation_types" => [
    ],

    "post_migrate" => [
    ],
];
