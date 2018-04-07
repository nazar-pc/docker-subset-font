<?php
/**
 * @package Subset font
 * @author  Nazar Mokrynskyi <nazar@mokrynskyi.com>
 * @license 0BSD
 */
if (!file_exists('/style.css') || !file_exists('/font.woff2')) {
	echo <<<HELP
Modifies font file to only include characters from specified CSS file.

Examples:
  docker run --rm -it --volume=/path/to/font.woff2:/font.woff2 --volume=/path/to/style.css:/style.css nazarpc/subset-font
HELP;
}

$css = file_get_contents('/style.css');

preg_match_all('/{[^}]*content[^}]*:[^}]*\\\([a-f0-9]+?)/Uim', $css, $unicode_characters);
$unicode_characters = array_unique($unicode_characters[1]);
sort($unicode_characters);

copy('/font.woff2', '/tmp/font.woff2');
// glyphIgo (python-fontforge actually) doesn't work with *.woff2, so let's decompress it first
system('woff2_decompress /tmp/font.woff2') !== false || exit;

$binary = '';
foreach ($unicode_characters as $character) {
	$character = str_pad($character, 4, '0', STR_PAD_LEFT);
	$binary    .= "\u$character";
}
$binary = json_decode("\"$binary\"");var_dump(strlen($binary));
file_put_contents('/tmp/characters', $binary);
system('glyphIgo subset -f /tmp/font.ttf --plain /tmp/characters -o /tmp/font.ttf') !== false || exit;
// We want *.woff2 eventually, so let's compress it and remove original *.ttf file
system('woff2_compress /tmp/font.ttf') !== false || exit;
file_put_contents('/font.woff2', file_get_contents('/tmp/font.woff2'));
