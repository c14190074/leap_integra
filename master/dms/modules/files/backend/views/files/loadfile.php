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

<?php if(count($local_breadcrumbs) > 0) : ?>
<nav aria-label="breadcrumb" class="p-3 pt-0">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 px-0 me-sm-6 me-5 pt-0">
    <?php foreach($local_breadcrumbs as $data) : ?>
      <?php if(end($local_breadcrumbs) == $data) : ?>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $data['name'] ?></li>
      <?php else : ?>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $data['url'] ?>"><?= $data['name'] ?></a></li>
      <?php endif; ?>
      
    <?php endforeach; ?>    
  </ol>
</nav>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <h6 class="mb-0">&nbsp;</h6> -->
                    </div>
                   
                </div>
            </div>

            <div class="card-body p-3 pt-0">
                <?= getDocumentText(Snl::app()->rootDirectory() . 'uploads/documents/'.$filename); ?>
            </div>
        </div>
    </div>

   
</div>
    