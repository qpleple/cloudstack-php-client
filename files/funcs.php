<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator;

use MyENA\CloudStackClientGenerator\API\VariableContainer;

/**
 * @param int $leading
 * @param int $trailing
 * @return string
 */
function tagIndent(int $leading, int $trailing = 0): string
{
    return str_repeat(' ', $leading) . ' * ' . ($trailing > 0 ? str_repeat(' ', $trailing) : '');
}

/**
 * @param string $in
 * @return string
 */
function escapeSwaggerString(string $in): string
{
    return str_replace('"', '""', $in);
}

/**
 * @param string $swaggerName
 * @param string $description
 * @param \MyENA\CloudStackClientGenerator\API\VariableContainer $variables
 * @param int $indent
 * @param bool $newline
 * @return string
 */
function buildSwaggerDefinitionTag(
    string $swaggerName,
    string $description,
    VariableContainer $variables,
    int $indent = 4,
    bool $newline = false
): string {
    $tag = tagIndent($indent) . "@SWG\\Definition(\n";
    $tag .= tagIndent($indent, 4) . "definition=\"{$swaggerName}\",\n";
    $tag .= tagIndent($indent, 4) . "type=\"object\",\n";
    $tag .= tagIndent($indent, 4) . "description=\"{$description},\n";

    if (0 < count($required = $variables->getRequired())) {
        $names = [];
        foreach ($required as $var) {
            $names[] = $var->getName();
        }
        $tag .= tagIndent($indent, 4) . 'required={"' . implode('","', $names) . "\"},\n";
    }

    foreach ($variables as $variable) {
        $tag .= $variable->getSwaggerPropertyTag(false, $indent) . ",\n";
    }

    return rtrim($tag, "\n,") . "\n" . tagIndent($indent) . ')' . ($newline ? "\n" : '');
}

/**
 * @param string $since
 * @param int $indent
 * @param bool $newline
 * @return string
 */
function buildSinceTagLine(string $since, int $indent = 4, bool $newline = false): string
{
    if ('0.0' === $since) {
        return '';
    }

    return tagIndent($indent) . '@since ' . $since . ($newline ? "\n" : '');
}

/**
 * @param bool $required
 * @param int $indent
 * @param bool $newline
 * @return string
 */
function buildRequiredTagLine(bool $required, int $indent = 4, bool $newline = false): string
{
    return tagIndent($indent) . '@' . ($required ? 'required' : 'optional') . ($newline ? "\n" : '');
}

/**
 * PHPDoc Tag helper func
 *
 * TODO: needs more work to be really useful, leaving the stub.
 *
 * @param string $tagName Name of tag
 * @param string $tagValue Value of tag
 * @param bool $annotation Is this tag an annotation or not.  If true, will wrap output in parenthesis
 * @param int $indentLevel Number of spaces to prefix per output line
 * @param bool $trailingNewline Append a \n character to output
 * @return string
 */
function buildTag(
    string $tagName,
    string $tagValue,
    bool $annotation = false,
    int $indentLevel = 4,
    bool $trailingNewline = false
): string {

    $vlen = strlen($tagValue);

    $tag = sprintf('%s * @%s%s', tagIndent($indentLevel), $tagName, ($annotation ? '(' : ''));

    // if this is just an empty value tag
    if (0 === $vlen) {
        return sprintf(
            '%s%s%s',
            $tag,
            ($annotation ? ')' : ''),
            ($trailingNewline ? "\n" : '')
        );
    }

    return sprintf(
        '%s%s%s%s',
        $tag,
        $tagValue,
        ($annotation ? ')' : ''),
        ($trailingNewline ? "\n" : '')
    );
}