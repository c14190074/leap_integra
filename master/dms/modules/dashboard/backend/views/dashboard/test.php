<?php
    // https://phpword.readthedocs.io/en/latest/writersreaders.html
    // https://stackoverflow.com/questions/10646445/read-word-document-in-php
    require_once 'vendor/autoload.php';
    use PhpOffice\PhpWord\Element\AbstractContainer;
    use PhpOffice\PhpWord\Element\Text;
    use PhpOffice\PhpWord\IOFactory as WordIOFactory;

    
    function getDocumentText(string $filepath): string
    {
        $document = WordIOFactory::createReader('Word2007')
            ->load($filepath);
        $documentText = '';

        foreach ($document->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                $text = getElementText($element);
                
                if (strlen($text)) {
                    // This ensures that the text from one section doesn't stickRightToTheNextSectionLikeThis
                    $documentText.= getElementText($element) . "<br /><br />";
                }
            }
        }

        return $documentText;
    }

    function getElementText($element): string
    {
        $result = '';

        if ($element instanceof AbstractContainer) {
            foreach ($element->getElements() as $subElement) {
                $result .= getElementText($subElement);
            }
        }

        if (method_exists($element, 'getText')) {
            $result .= $element->getText();
        }

        return $result;
    }
?>

<div class="row">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Aktivitas</h6>
                    </div>
                   
                </div>
            </div>

            <div class="card-body p-3 pt-0">
                <?= getDocumentText(Snl::app()->rootDirectory() . 'uploads/documents/FileDoc.docx'); ?>
            </div>
        </div>
    </div>

   
</div>
    