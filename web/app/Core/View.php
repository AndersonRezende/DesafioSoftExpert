<?php

namespace DesafioSoftExpert\Core;

class View
{
    private static string $yieldPattern = '/@yield\s*(\(\'[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\'\))/';
    private static string $layoutPattern = '/@layout\s*(\(\'[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\'\))/';

    /**
     * Variáveis padrões da view
     * @var array
     */
    private static array $vars = [];

    /**
     * Método responsável por retornar o conteudo da view
     * @param string $view
     * @return false|string
     */
    private static function getContentView(string $view)
    {
        $file = __DIR__.'/../Views/'.$view.'.php';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por retornar o conteúdo do layout
     * @param string $layout
     * @return false|string
     */
    private static function getContentLayout(string $layout)
    {
        $file = __DIR__.'/../Views/layout/'.$layout.'.php';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por buscar o nome do layout na view
     * @param string $content
     * @return false|string
     */
    private static function getLayoutName(string $content)
    {
        preg_match(self::$layoutPattern, $content, $matches);
        $layoutName = trim($matches[1]);
        return substr($layoutName, 2, strpos($layoutName, ')') - 3);
    }

    /**
     * Método responsável por buscar o layout e unificar com o conteúdo da view
     * @param $contentView
     * @return array|false|string|string[]
     */
    private static function renderWithLayout($contentView)
    {
        $layoutName = self::getLayoutName($contentView);
        $contentView = preg_replace(self::$layoutPattern, '', $contentView);
        $layout = self::getContentLayout($layoutName);
        return str_replace("@yield('content')", $contentView, $layout);
    }

    /**
     * Método responsável por retornar a view renderizada junto com o layout e as variáveis
     * @param string $view
     * @param array $vars (string/numeric)
     * @return false|string
     */

    private static function processVariables($contentView)
    {
        $keys = array_keys(self::$vars);
        $keys = array_map(function ($key) {
            return '{{'.$key.'}}';
        }, $keys);

        return str_replace($keys, array_values(self::$vars), $contentView);
    }

    private static function processConditionals($contentView)
    {
        $contentView = preg_replace('/@if\s*\((.*?)\)/', '<?php if ($1): ?>', $contentView);
        $contentView = preg_replace('/@elseif\s*\((.*?)\)/', '<?php elseif ($1): ?>', $contentView);
        $contentView = preg_replace('/@else/', '<?php else: ?>', $contentView);
        $contentView = preg_replace('/@endif/', '<?php endif; ?>', $contentView);

        return $contentView;
    }

    private static function processLoops($contentView)
    {
        $contentView = preg_replace('/@foreach\s*\((.*?)\)/', '<?php foreach ($1): ?>', $contentView);
        $contentView = preg_replace('/@endforeach/', '<?php endforeach; ?>', $contentView);
        return $contentView;
    }

    public static function render(string $view, array $vars = [])
    {
        self::$vars = $vars;
        $contentView = self::getContentView($view);
        $contentView = self::processLoops($contentView);
        $contentView = self::processConditionals($contentView);
        $contentView = self::processVariables($contentView);

        $contentView = preg_replace_callback('/{{\s*(.*?)\s*}}/', function ($matches) {
            return '<?php echo htmlspecialchars(' . $matches[1] . '); ?>';
        }, $contentView);

        extract(self::$vars);

        ob_start();
        eval('?>' . $contentView);
        $output = ob_get_clean();

        return self::renderWithLayout($output);
    }

    public static function renderPartial($partial, $vars = [])
    {
        $contentView = self::getContentView($partial);
        $vars = array_merge(self::$vars, $vars);

        $keys = array_keys($vars);
        // Mapeia os dados separados por chaves na view
        $keys = array_map(function ($item) {
            return '{{'.$item.'}}';
        }, $keys);

        $contentView = str_replace($keys, array_values($vars), $contentView);
        return $contentView;
    }
}