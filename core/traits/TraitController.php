<?php

namespace core\traits;

trait TraitController
{


    /**
     * Undocumented function
     *
     * @param string $path
     * @param array $data
     * @return string
     */
    private function getContent(string $path, array $data = []): string
    {
        ob_start();
        extract($data);
        include($path);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getFolder(): string
    {
        $folder = explode('\\', get_class($this));
        return mb_strtolower($folder[count($folder) - 1]);
    }
}
