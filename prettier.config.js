/**
 * @see https://prettier.io/docs/en/configuration.html
 * @type {import("prettier").Config}
 */

export default {
  singleQuote: true,
  semi: false,
  trailingComma: 'es5',
  bracketSpacing: true,
  bracketSameLine: true,
  plugins: ['@destination/prettier-plugin-twig'],
  overrides: [
    {
      files: '*.twig',
      options: {
        singleQuote: false,
      },
    },
  ],
}
