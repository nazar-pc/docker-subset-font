# Subset font
This is a simple tool takes `*.woff2` icon font and corresponding `*.css` file and modifies `*.woff2` file so that it only includes characters from `*.css` file.

For instance, if you have a large font file (like beautiful [Font Awesome](https://fontawesome.com/)) and only use a few icons - this tool will help you to reduce the whole file to just those few characters.

WOFF2 format is supported across all major evergreen browsers, so this tool only supports WOFF2 and ignores anything else.

# Usage
Before using this, make sure you have [Docker installed](https://www.docker.com/community-edition#/download) on your machine.
```
Modifies font file to only include characters from specified CSS file.

Examples:
  docker run --rm -v /path/to/font.woff2:/font.woff2 -v /path/to/style.css:/style.css nazarpc/subset-font
```

## Contribution
Feel free to create issues and send pull requests (for big changes create an issue first and link it from the PR), they are highly appreciated!

## License
Free Public License 1.0.0 / Zero Clause BSD License

https://opensource.org/licenses/FPL-1.0.0

https://tldrlegal.com/license/bsd-0-clause-license
