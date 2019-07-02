# Paleo Profiles
Vector-based profiles of paleontological specimens.

## Structure

Files are SVG contianing multiple layers. Each layer has a class name for targeting with CSS/JS.

* Outline of entire specimen (`class="outline"`)
* Full specimen (`class="skull"`)
  * Base layer (`class="base"`)
* Teeth (`class="teeth"`)
* Fenestrae (`class="fenestrae"`)

## Styles

Initial styles included in every SVG simply present a basic line drawing. When included in a web page, they individual layers can be more specifically targeted.

## Phylogeny

Each SVG also contains metadata with a [phylogenic tree](http://www.phyloxml.org).

```
<metadata>
    <phyloxml xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.phyloxml.org" xsi:schemaLocation="http://www.phyloxml.org http://www.phyloxml.org/1.10/phyloxml.xsd">
        <phylogeny rooted="true" rerootable="false">
            <clade>
                <name>Animalia</name>
                <clade>
                    <name>Chordata</name>
                    <clade>
                        <name>Dinosauria</name>
                        <clade>
                            <name>Saurischia</name>
                            <clade>
                                <name>Theropoda</name>
                                <clade>
                                    <name>Abelisauria</name>
                                    <clade>
                                        <name>Abelisauridae</name>
                                        <clade>
                                            <name>Majungasaurinae</name>
                                            <clade>
                                                <name>Majungasaurus</name>
                                            </clade>
                                        </clade>
                                    </clade>
                                </clade>
                            </clade>
                        </clade>
                    </clade>
                </clade>
            </clade>
        </phylogeny>
    </phyloxml>
</metadata>
```

## Example
Majungasaurus crenatissimus

<img src="https://raw.githubusercontent.com/zooley/paleoprofiles/master/animalia/dinosauria/Majungasaurus-crenatissimus.svg?sanitize=true" width="300" alt="Majungasaurus crenatissimus" />

## Catalog

A simple catalog of specimens is available as a `.php` file.