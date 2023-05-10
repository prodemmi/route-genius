<?php

namespace Prodemmi\RouteGenius;

class RouteGenius
{
    protected array $routeData = [];

    public function __construct()
    {
        $files           = $this->rsearch('app/Http/Controllers/');
        foreach ($files as $file) {
            $namespace        = $this->getNamespaceFromFile($file);
            $controllerName   = basename($file, '.php');
            $class            = "$namespace\\$controllerName";
            $r                = new \ReflectionClass($class);
            $this->routeData[$class] = $this->getAttributes($r);
        }
    }

    public function getRouteData()
    {
        return $this->routeData;
    }

    protected function getAttributes(\ReflectionClass $r): array
    {
        $methodAttributes  = [];
        $controllerMethods = array_filter($r->getMethods(\ReflectionMethod::IS_PUBLIC), function ($method) {
            return count($method->getAttributes());
        });
        foreach ($controllerMethods as $method) {
            $methodAttributes[$method->getName()] = $method->getAttributes();
        }

        return [
            'controller' => $r->getAttributes(),
            'methods'    => $methodAttributes,
        ];
    }

    protected function getNamespaceFromFile(string $filename): ?string
    {
        $fileContents = file_get_contents($filename);
        preg_match('/^namespace\s+(.+?);/m', $fileContents, $matches);

        return $matches[1] ?? null;
    }

    protected function rsearch($folder)
    {
        return glob("$folder/{,*/,*/*/,*/*/*/}*Controller.php", GLOB_BRACE);
    }
}
