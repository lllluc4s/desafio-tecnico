<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('node_modules')
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
$config
    ->setRules([
        '@PSR12'                 => true,
        'array_syntax'           => ['syntax' => 'short'],
        'binary_operator_spaces' => [
            'default'   => 'single_space',
            'operators' => [
                '=>' => 'align_single_space_minimal',
                '='  => 'align_single_space_minimal',],
        ],
        'blank_line_before_statement'           => ['statements' => ['return']],
        'cast_spaces'                           => ['space' => 'single'],
        'concat_space'                          => ['spacing' => 'one'],
        'declare_strict_types'                  => false,
        'function_typehint_space'               => true,
        'no_blank_lines_before_namespace'       => false,
        'no_empty_statement'                    => true,
        'no_extra_blank_lines'                  => ['tokens' => ['break', 'continue', 'return']],
        'no_trailing_comma_in_singleline_array' => true,
        'phpdoc_add_missing_param_annotation'   => true,
        'phpdoc_align'                          => ['align' => 'left'],
        'phpdoc_order'                          => true,
        'phpdoc_scalar'                         => true,
        'phpdoc_separation'                     => true,
        'phpdoc_summary'                        => true,
        'phpdoc_to_comment'                     => false,
        'phpdoc_trim'                           => true,
        'phpdoc_types'                          => true,
        'phpdoc_var_annotation_correct_order'   => true,
        'return_type_declaration'               => true,
        'single_quote'                          => true,
        'trailing_comma_in_multiline'           => true,
        'yoda_style'                            => true,
    ])
    ->setFinder($finder);

return $config;
