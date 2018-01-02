const argv = require('yargs').argv
const command = require('node-cmd')
const mix = require('laravel-mix')
const OnBuild = require('on-build-webpack')
const Watch = require('webpack-watch')
const tailwind = require('tailwindcss')
const glob = require('glob-all')
let PurgecssPlugin = require("purgecss-webpack-plugin")
const fs = require('fs')

const env = argv.e || argv.env || 'local'
const plugins = [
    new OnBuild(() => {
        command.get('./vendor/bin/jigsaw build ' + env, (error, stdout, stderr) => {
            if (error) {
                console.log(stderr)
                process.exit(1)
            }
            console.log(stdout)
        })
    }),
    new Watch({
        paths: ['source/**/*.md', 'source/**/*.php'],
        options: { ignoreInitial: true }
    }),
]

class TailwindExtractor {
  static extract(content) {
    return content.match(/[A-z0-9-:\/]+/g);
  }
}

mix.webpackConfig({ plugins })
mix.setPublicPath('source')

mix
  .js('source/_assets/js/app.js', 'source/js')
  .less('source/_assets/less/main.less', 'source/css')
  .options({
    postCss: [
      tailwind('tailwind.js'),
    ]
  })
  .version();

if (mix.inProduction()) {
    mix.webpackConfig({
      plugins: [
        new PurgecssPlugin({
          paths: glob.sync([
            path.join(__dirname, "build_production/**/*.html")
          ]),
          extractors: [
            {
              extractor: TailwindExtractor,
              extensions: ["html"]
            }
          ],
        })
      ]
    });
}

