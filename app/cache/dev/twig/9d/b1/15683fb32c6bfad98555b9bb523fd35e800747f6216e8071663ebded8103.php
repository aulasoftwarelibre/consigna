<?php

/* WebProfilerExtraBundle:Collector:container.html.twig */
class __TwigTemplate_9db115683fb32c6bfad98555b9bb523fd35e800747f6216e8071663ebded8103 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "displayInWdt", array())) {
            // line 5
            echo "        ";
            $context["icon"] = ('' === $tmp = "            <img height=\"28\" alt=\"Container\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAcCAMAAABWBG9SAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDoyMjY5ODc3MjRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDoyMjY5ODc3MzRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjIyNjk4NzcwNEVEMjExRTI5RDM1QjZBOTBCNThGRTZCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjIyNjk4NzcxNEVEMjExRTI5RDM1QjZBOTBCNThGRTZCIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+aeuERwAAASBQTFRFQD8/RUVFubi49/f3e3p6rKurmJeXsbGxr6+v7u7uU1NT19bWyMjI5+fnY2JiQUFBxMTE2dnZt7e3YWBg39/faGdnS0tLUE9PgYCAgIB/5+bmUVFRTk5OYmJhvb299/b2ycnJr66tUlJSpqWkurm5kZGQsbCw0dDQd3d2kI+PcnBwxsXFvLu7oaCgWVlYy8vKTU1MW1patLOzy8vLenp6oqGglZWVRkZGp6eml5aWaWlpcXFxRkVFvby8gYB/aWlo/Pz8Y2NjQD9ApaWkP0BAf39/lJOTeHd3p6amr66uw8PDlZWU+/v73d3deXh4RUVG7e3tcXBwcnFwjYyM6+vrxsbGxsbFl5eX2travb2829vbs7OzT09PPz8/QEBA////blEBcwAAAGB0Uk5T//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8Ac23kQwAAANRJREFUeNpiiMcCGKgkKG8byYwm6OOrphVkJOKAEAzR9hZlZIiNjTW3Cg8NAAmK6AYaxMXGxoFBbKyLjLWpFIOCsqseA0IwzlDSQ53BUUJRwMvZLwYkIW1iESbgaSfLIBYby2hvqWKsE6wpp89kJmoTGyvGEAPRpeQeEaUhDjE8BiwINo6DA2owkmBcdHQc/QX9ndAFYxkZVIX5IT6HCMbG8gu7McQzC7KycMXFMrCzM8TGcbGwCjJDA5mTh41PSIiPjYcTJTp4mbi5mXipHMXIACDAAPMEsv90Bi2uAAAAAElFTkSuQmCC\"/>
            <span class=\"sf-toolbar-info-piece-additional-detail\">Container</span>
        ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 9
            echo "        ";
            ob_start();
            // line 10
            echo "            <div class=\"sf-toolbar-info-piece\">
                <b>Services</b>
                <span>";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "servicecount", array()), "html", null, true);
            echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Parameter<br />namespaces</b>
                <span>";
            // line 16
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "parameters", array())), "html", null, true);
            echo "</span>
            </div>
        ";
            $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 19
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")))));
            // line 20
            echo "    ";
        }
    }

    // line 23
    public function block_menu($context, array $blocks = array())
    {
        // line 24
        echo "    <span class=\"label\">
        <span class=\"icon\">
            <img width=30 src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAAAyCAYAAADx/eOPAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MzBCQTQ1NUI0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MzBCQTQ1NUM0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxOEMwOUJERTRCQzUxMUUwQThCMUI5MzhDMjZDM0Q2MiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozMEJBNDU1QTRCQzUxMUUwQThCMUI5MzhDMjZDM0Q2MiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pg7ztUAAAAfqSURBVHja7FpbjBtX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\" />
        </span>
        <strong>Container</strong>
        <span class=\"count\">
            <span>";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "servicecount", array()), "html", null, true);
        echo "</span>
        </span>
    </span>
";
    }

    // line 35
    public function block_panel($context, array $blocks = array())
    {
        // line 36
        echo "    ";
        if (twig_test_empty($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "services", array()))) {
            // line 37
            echo "        <em>No debug container information</em>
    ";
        } else {
            // line 39
            echo "        <h2>Container Parameters</h2>
        <table>
            ";
            // line 41
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "parameters", array()));
            foreach ($context['_seq'] as $context["service"] => $context["parameters"]) {
                // line 42
                echo "                <tr>
                    <th>";
                // line 43
                echo twig_escape_filter($this->env, $context["service"], "html", null, true);
                echo "</th>
                    <td>
                        <table>
                            ";
                // line 46
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($context["parameters"]);
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 47
                    echo "                                <tr>
                                    <th width=\"420\"><code>";
                    // line 48
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "</code></th>
                                    <td>
                                        ";
                    // line 50
                    echo twig_escape_filter($this->env, $this->env->getExtension('yaml')->dump($context["value"]), "html", null, true);
                    echo "
                                    </td>
                                </tr>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 54
                echo "                        </table>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['service'], $context['parameters'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            echo "        </table>

        <h2>Container Services:</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Scope</th>
                <th>Class Name</th>
            </tr>
            ";
            // line 67
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "services", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["service_id"] => $context["service"]) {
                // line 68
                echo "                <tr class=\"";
                echo ((($this->getAttribute($context["loop"], "index", array()) % 2 == 1)) ? ("odd") : ("even"));
                echo "\">
                    <th><code>";
                // line 69
                echo twig_escape_filter($this->env, $context["service_id"], "html", null, true);
                echo "</code></th>
                    <td>
                        ";
                // line 71
                if ($this->getAttribute($context["service"], "scope", array(), "any", true, true)) {
                    // line 72
                    echo "                            ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["service"], "scope", array()), "html", null, true);
                    echo "
                        ";
                } else {
                    // line 74
                    echo "                            N/A
                        ";
                }
                // line 76
                echo "                    </td>
                    <td>
                        ";
                // line 78
                if ($this->getAttribute($context["service"], "class", array(), "any", true, true)) {
                    // line 79
                    echo "                            ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["service"], "class", array()), "html", null, true);
                    echo "
                        ";
                } elseif ($this->getAttribute($context["service"], "alias", array(), "any", true, true)) {
                    // line 81
                    echo "                            alias to ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["service"], "alias", array()), "html", null, true);
                    echo "
                        ";
                }
                // line 83
                echo "                    </td>
                </tr>
            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['service_id'], $context['service'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 86
            echo "        </table>
    ";
        }
    }

    public function getTemplateName()
    {
        return "WebProfilerExtraBundle:Collector:container.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  230 => 86,  214 => 83,  208 => 81,  202 => 79,  200 => 78,  196 => 76,  192 => 74,  186 => 72,  184 => 71,  179 => 69,  174 => 68,  157 => 67,  146 => 58,  137 => 54,  127 => 50,  122 => 48,  119 => 47,  115 => 46,  109 => 43,  106 => 42,  102 => 41,  98 => 39,  94 => 37,  91 => 36,  88 => 35,  80 => 30,  72 => 24,  69 => 23,  64 => 20,  61 => 19,  55 => 16,  48 => 12,  44 => 10,  41 => 9,  36 => 5,  33 => 4,  30 => 3,);
    }
}
