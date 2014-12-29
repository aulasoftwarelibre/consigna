<?php

/* WebProfilerExtraBundle:Collector:assetic.html.twig */
class __TwigTemplate_ff19f47188cb88cee1fd609ac179009abcc1890598b9f7a8ae1092b9070b70bc extends Twig_Template
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
            $context["icon"] = ('' === $tmp = "            <img height=\"28\" alt=\"Assetic\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAcCAMAAABbGh8VAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDoyMjY5ODc2RTRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDoyMjY5ODc2RjRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjIyNjk4NzZDNEVEMjExRTI5RDM1QjZBOTBCNThGRTZCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjIyNjk4NzZENEVEMjExRTI5RDM1QjZBOTBCNThGRTZCIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+oJdgdgAAAVlQTFRFd3d3UFBQ8fHxPj4+8vLyg4ODnZ2dgYGB9vb22traTExMgoKCf39/h4eHPDw8RUVFaGhonJyck5OTQEBARkZG19fXwsLCsbGxT09PeHd3PT09s7OzdnV1kJCQWlpaUVBQ+Pj4a2tr2NjYSUlJX19f7u7uvb29Q0NDV1dXjo2O4uLi6+vrpKSk9PTzi4uLYGBgk5ST1dXVqamplpaWU1NTn5+fOTk5U1JSp6en2dnZpaWluLi47+7v9PT0bm5ud3Z23t7eysrKubm5y8vLcnJyNDQ0+vr6aWpqRERE3d3d6enpeHh4qKio8PDw5+fneHd41tbWVFRTsbCwYmJi9fX1fn5+oqKidHNzZ2doeXh4ZWVl5eXlcXBwmpqasLCwODg48/PzVFRUxMTE39/f6unpenp6fX19NjY2rq6uXV1d7+/vVVVVhISESkpKsrKyOzs7SEhIPz8/////tq7LNgAAAHN0Uk5T////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////AO+Lr34AAAEHSURBVHjafNFnU8IwGMDxB1K67GIvQVTce28RcOPee2+BNn7/F9okXK/29P/yd8mTSwJfnuAPyoWEqp3Qv9qggbxVs4s8d4iMuH1MQqfRlwVG3YwKly09R4Tu7hldiTtLffBUfJC4KUpYXms1huFGN5s/PrGTAvHILwpA3TLBS0kXNXlXuegWaSuvyDXL0OXBCp21SwiFpYtYaS9z7KxKhWeMkS3lTHBo0pSGsnMb10qDtPF09nG5U1Z7yYnJeRmn1mPSGxqNtqlg07k4y/NBfpoPjp1MhOI/pC1ubvtJHH37uoW7fLTEoZ/Qge7cxUcpnWivsax3shPKaqDKEjLif1/r7luAAQDrTKWvW5hpqwAAAABJRU5ErkJggg==\"/>
            <span class=\"sf-toolbar-info-piece-additional-detail\">Assetic</span>
        ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 9
            echo "        ";
            ob_start();
            // line 10
            echo "            <div class=\"sf-toolbar-info-piece\">
                <b>Collections</b>
                <span>";
            // line 12
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "collections", array())), "html", null, true);
            echo "</span>
            </div>
        ";
            $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 15
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")))));
            // line 16
            echo "    ";
        }
    }

    // line 19
    public function block_menu($context, array $blocks = array())
    {
        // line 20
        echo "    <span class=\"label\">
        <span class=\"icon\">
            <img width=25 src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAAA3CAYAAAB6i9geAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MThDMDlCRDQ0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MThDMDlCRDU0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpEMDRGQkZBMTRCQzMxMUUwQThCMUI5MzhDMjZDM0Q2MiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpEMDRGQkZBMjRCQzMxMUUwQThCMUI5MzhDMjZDM0Q2MiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pk9zgzcAAAWtSURBVHja7FpNSCRHFK7q6flzZkchkIxsognZy4as8bIQsh7cnCRIICDRS0CIhxw8eJRFQg4GvASECCE3T+pBspckeFsPHjYhycpKbpNIVBwRNjq/7fx0V95X0zXbumNP67ajQh48+2equ77+3ntfVXXLhRDsOpjGronp+PPh/fvMsizpnHO39j3U4Dtq00n7RXL+Mn3TfdLCssa6u7tT79y+/cqdnh4j0d5erFar9UaIOFwC7ejoYIZhsGw2yzTNleRXtUDgPdrGfAmnpt2MtrV1FovF1NONjbff6Or6NxgKpcrlsuQALOQKOWZWzRrQRCIhAWZzOUb4m6SKeEkij5mItbXFcvk8+2tz82ahWPxi+NPhr6LR6FbVNEEnO3h2wCqVci1Hif5jVLsYXc2qPqaeZQlhgqQb8Xh+d3f3k4XFhW9LpVIyFApJ8gIBeKBRMbmyJWz33YggKxaLmfv7+x8vLi3OGsXia+FwmCneTklIfprzmvtn3BFJFHMkEmHE7PDCwsL32WyuC2BPYdR5EyHzxOF0Smg+M8k0evZgMBgK6nqBPEM1c5De2/3op59//JIK7V1q85budpOqadWkgZ6oTqSvhEoWua7rLBGP/0knPkcdkGxZxGQ4l8tq29v/BMLhiH4qUOhppVJhpHHsiKTrMHNoa6x/Vc+5RmSYFtSGCmeLTm2dbPP4l1+fC75bWKAIg4OD7IeHD1mhUKB84cLPAioaRhex+j7th178WYQq1QoJgyhKoJQjCWIrSLuBE1Wt0YFJoTmky6pSxpCnPoXfNM0YjUJfU9+RBmoCLKbGtceMi78lUOPoaJjC3Ev036HDCl0oEGaqtggB2ySpeEDkbl9A0Qepn6TL7yXyI3qEGqP5QuFNerq7NDzedcJAktNjJnO5XNQSpo3R15GpebXVxlKu2YVToT8GazQqCQGGLYeWtn5eKK7LNI9ffaCIHqJ5llFGDfOCt5ZLIpOUxgNQ5CRU6hJz1FvowaDFL4nRM4X+wqZ2nkPPmIfQQzzl8sQ53Wt1SQkPobfJPzbdu5rLZTtH1fDJr2wxXao81ZFej5HJU46+uI5qZehrFcK5uOqM1kcmvVU9zs7Oyu3c3BxLpVJyP5lMstHRUdbX18fi8TjL5/NsfX2dzc/P19souB6A2kOocyV6jslzb2+v3AKQ2gI8wCrDOYBG27GxMZZOp88xKfFZngAIIMHixMQE6+/vl+BwDMBDQ0Pn1FEnoz6YYnJvb0+GG4ZwI+zq+HmOsjPkqM8jqAJz69YttrS0xJaXl+U5bOEns0+/LHkCqJWVFTYwMCDZHR8frzOM82D2fBNnn0MPm5mZkb62tnYsJaAEk5OTZ5UnNXG+GAN7cFVgYFhtiVW+s7Nzxomzx6pXYVS66aarq6urEpAyMDs1NVU/7uzsZOdYM3kzJS3QQqWdaqtyUL5LIBmCoa3SVpgTOOmorUzeRqbatMmj4ENiAAbMTk9Py2NUtiogBRSVjRCrqkc7AHa2tQXf6+yJOxcCnpYlCB8AoWOwiS06doZVHTvbKZDIWUdb+VlE91BLxGA9RyOs9kLL1cDOyMiI7BggAEYx6TTkJFy1U9eqtCDDG74EcXVD9xB4gXS2al8p9si/ka9/PDB7bGJxvnYAmqGennmRJ1rbBcS9D+6xR6uPMJzATZ+mcM1qAzknMTZ9kRsIaGapVCr/9sfvLBgKmdyH1464r2maMiL4kOByTywry02B4ialcjn6ZP1Jn2EYaU3Twj6pGPL8KfkmvoSgn2bmChTvRzOZzOuY7wZqd/Nj+ESfeEH7GYDa7MqPX27RapqjhA8shn0eF0wbrDMVXNPgstZMDRXDcnzqvCpATy0y5yfwRkC1FoN27a8RWNUYOdjWQqDoz7XUkbNOsVXFhC9mG+Tt5BVbvy4S5CH5QbM0cOYs//+fX3y2/wQYAD8x1OGH5KXsAAAAAElFTkSuQmCC\" />
        </span>
        <strong>Assetic</strong>
        <span class=\"count\">
            <span>";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "collectionCount", array()), "html", null, true);
        echo "</span>
        </span>
    </span>
";
    }

    // line 31
    public function block_panel($context, array $blocks = array())
    {
        // line 32
        echo "    <h2>Assetic</h2>
    ";
        // line 33
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "collections", array()))) {
            // line 34
            echo "        <table>
            <tr>
                <th>Collection</th>
                <th>Sources</th>
                <th>Filters</th>
                <th>Target Url</th>
            </tr>
            ";
            // line 41
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "collections", array()));
            foreach ($context['_seq'] as $context["i"] => $context["collection"]) {
                // line 42
                echo "                <tr class=\"";
                echo ((($context["i"] % 2 == 1)) ? ("odd") : ("even"));
                echo "\">
                    <th align=\"center\">
                        ";
                // line 44
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "
                    </th>
                    <td>
                        <ul>
                            ";
                // line 48
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["collection"], "assets", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["asset"]) {
                    // line 49
                    echo "                                <li><code>";
                    echo twig_escape_filter($this->env, $context["asset"], "html", null, true);
                    echo "</code></li>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['asset'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 51
                echo "                        </ul>
                    </td>
                    <td>
                        <ul>
                            ";
                // line 55
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["collection"], "filters", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["filter"]) {
                    // line 56
                    echo "                                <li><code>";
                    echo twig_escape_filter($this->env, $context["filter"], "html", null, true);
                    echo "</code></li>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 58
                echo "                        </ul>
                    </td>
                    <td>
                        <a target=\"_blank\" href=\"";
                // line 61
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "basePath", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["collection"], "target", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["collection"], "target", array()), "html", null, true);
                echo "</a>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['i'], $context['collection'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 65
            echo "        </table>
    ";
        } else {
            // line 67
            echo "        <p>
            <em>No assetic collection</em>
        </p>
    ";
        }
    }

    public function getTemplateName()
    {
        return "WebProfilerExtraBundle:Collector:assetic.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 67,  166 => 65,  152 => 61,  147 => 58,  138 => 56,  134 => 55,  128 => 51,  119 => 49,  115 => 48,  108 => 44,  102 => 42,  98 => 41,  89 => 34,  87 => 33,  84 => 32,  81 => 31,  73 => 26,  65 => 20,  62 => 19,  57 => 16,  54 => 15,  48 => 12,  44 => 10,  41 => 9,  36 => 5,  33 => 4,  30 => 3,);
    }
}
