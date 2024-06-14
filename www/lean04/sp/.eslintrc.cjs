module.exports = {
    root: true,
    env: { browser: true, es2020: true },
    ignorePatterns: ['build', 'vendor', '.eslintrc.cjs', 'vite.config.ts'],
    extends: ['react-app'],
    parser: '@typescript-eslint/parser',
    plugins: ['react-refresh', 'simple-import-sort'],
    rules: {
        'simple-import-sort/imports': [
            'error',
            {
                groups: [
                    // Side effect imports.
                    ['^\\u0000'],
                    // Packages.
                    // Things that start with a letter (or digit or underscore), or `@` followed by a letter.
                    ['^(react|react-dom)(/.*|$)', '^(next)(/.*|$)', '^@?\\w'],
                    // Internal packages.
                    ['^(src)(/.*|$)'],
                    // Absolute imports and other imports such as Vue-style `@/foo`.
                    // Anything not matched in another group.
                    ['^'],
                    // Parent imports. Put `..` last.
                    ['^\\.\\.(?!/?$)', '^\\.\\./?$'],
                    // Other relative imports. Put same-folder imports and `.` last.
                    ['^\\./(?=.*/)(?!/?$)', '^\\.(?!/?$)', '^\\./?$'],
                    // Style imports.
                    ['^.+\\.s?css$'],
                ],
            },
        ],
        'simple-import-sort/exports': 'error',
        'import/first': 'error',
        'import/newline-after-import': 'error',
        'import/no-duplicates': 'error',
        'react-refresh/only-export-components': ['warn', { allowConstantExport: true }],

        // own rules
        'arrow-body-style': ['error', 'as-needed'],
        'arrow-parens': ['error', 'always'],
        'func-names': ['error'],
        'no-console': ['error'],
        'no-constant-condition': ['error'],
        'no-else-return': ['error', { allowElseIf: true }],
        'no-multiple-empty-lines': ['error', { max: 1, maxEOF: 1, maxBOF: 0 }],
        //   'no-restricted-exports': ['error', { restrictDefaultExports: { direct: true, named: true } }],
        'no-unused-vars': ['error'],
        'prefer-destructuring': ['error', { object: true, array: false }],
        'react/jsx-curly-brace-presence': ['error', { props: 'never', children: 'never' }],
    },
    overrides: [
        {
            parser: '@typescript-eslint/parser',
            parserOptions: {
                project: './tsconfig.json',
                tsconfigRootDir: __dirname,
            },
            files: ['**/*.ts', '**/*.tsx'],
            rules: {
                '@typescript-eslint/no-explicit-any': 'warn',

                // own rules
                '@typescript-eslint/adjacent-overload-signatures': 'error',
                '@typescript-eslint/await-thenable': 'error',
                '@typescript-eslint/consistent-type-assertions': 'error',
                '@typescript-eslint/consistent-type-definitions': 'error',
                '@typescript-eslint/func-call-spacing': 'error',
                '@typescript-eslint/member-delimiter-style': 'error',
                '@typescript-eslint/no-array-constructor': 'error',
                '@typescript-eslint/no-dynamic-delete': 'error',
                '@typescript-eslint/no-empty-interface': 'error',
                '@typescript-eslint/no-explicit-any': [
                    'error',
                    {
                        ignoreRestArgs: true,
                    },
                ],
                '@typescript-eslint/no-extra-non-null-assertion': 'error',
                '@typescript-eslint/no-extra-semi': 'error',
                '@typescript-eslint/no-extraneous-class': 'error',
                '@typescript-eslint/no-floating-promises': 'error',
                '@typescript-eslint/no-for-in-array': 'error',
                '@typescript-eslint/no-implied-eval': 'error',
                '@typescript-eslint/no-inferrable-types': 'error',
                '@typescript-eslint/no-loss-of-precision': 'error',
                '@typescript-eslint/no-misused-new': 'error',
                '@typescript-eslint/no-namespace': 'error',
                '@typescript-eslint/no-non-null-asserted-optional-chain': 'error',
                '@typescript-eslint/no-non-null-assertion': 'error',
                '@typescript-eslint/no-require-imports': 'error',
                '@typescript-eslint/no-shadow': 'error',
                '@typescript-eslint/no-this-alias': 'error',
                '@typescript-eslint/no-unnecessary-type-arguments': 'error',
                '@typescript-eslint/no-unnecessary-type-assertion': 'error',
                '@typescript-eslint/no-unnecessary-type-constraint': 'error',
                '@typescript-eslint/no-unused-vars': [
                    'error',
                    {
                        ignoreRestSiblings: true,
                        argsIgnorePattern: '^_',
                    },
                ],
                '@typescript-eslint/no-use-before-define': [
                    'error',
                    {
                        functions: false,
                        variables: false,
                    },
                ],
                '@typescript-eslint/no-useless-constructor': 'error',
                '@typescript-eslint/no-var-requires': 'error',
                '@typescript-eslint/prefer-as-const': 'error',
                '@typescript-eslint/prefer-for-of': 'error',
                '@typescript-eslint/prefer-function-type': 'error',
                '@typescript-eslint/prefer-includes': 'error',
                '@typescript-eslint/prefer-namespace-keyword': 'error',
                '@typescript-eslint/prefer-regexp-exec': 'error',
                '@typescript-eslint/prefer-string-starts-ends-with': 'error',
                '@typescript-eslint/prefer-ts-expect-error': 'error',
                '@typescript-eslint/promise-function-async': 'error',
                '@typescript-eslint/require-array-sort-compare': 'error',
                '@typescript-eslint/require-await': 'error',
                '@typescript-eslint/restrict-plus-operands': 'error',
                '@typescript-eslint/restrict-template-expressions': [
                    'error',
                    {
                        allowNumber: true,
                        allowBoolean: true,
                        allowAny: true,
                        allowNullish: true,
                    },
                ],
                '@typescript-eslint/semi': 'error',
                '@typescript-eslint/switch-exhaustiveness-check': 'error',
                '@typescript-eslint/triple-slash-reference': 'error',
                '@typescript-eslint/type-annotation-spacing': 'error',
                '@typescript-eslint/unbound-method': 'error',
                '@typescript-eslint/unified-signatures': 'error',
            },
        },
    ],
};
