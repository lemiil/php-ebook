<?php

it('can parse epub entity', function () {
    $book = Kiwilan\Ebook\Ebook::read(EPUB)->book();
    $firstAuthor = $book->authors()[0];

    expect($book)->toBeInstanceOf(Kiwilan\Ebook\BookEntity::class);
    expect($book->path())->toBe(EPUB);
    expect($book->title())->toBe("Le clan de l'ours des cavernes");
    expect($book->authorFirst()->name())->toBe('Jean M. Auel');
    expect($book->authors())->toBeArray();
    expect($firstAuthor->name())->toBe('Jean M. Auel');
    expect($book->description())->toBeString();
    expect($book->contributor())->toBeString();
    expect($book->rights())->toBeNull();
    expect($book->publisher())->toBe('Presses de la cité');
    expect($book->identifiers())->toBeArray();
    expect($book->identifiers()['google']->content())->toBe('63CTHAAACAAJ');
    expect($book->identifiers()['isbn13']->content())->toBe('9782266122122');
    expect($book->date())->toBeInstanceOf(DateTime::class);
    expect($book->date()->format('Y-m-d H:i:s'))->toBe('1980-01-13 21:00:00');
    expect($book->language())->toBe('fr');
    expect($book->tags())->toBeArray();
    expect($book->series())->toBe('Les Enfants de la Terre');
    expect($book->volume())->toBe(1);
    expect($book->rating())->toBeFloat();
    expect($book->rating())->toBe(10.0);
    expect($book->pageCount())->toBe(4);
    expect($book->words())->toBe(902);
});

it('can get epub cover', function () {
    $ebook = Kiwilan\Ebook\Ebook::read(EPUB);
    $path = 'tests/output/cover-EPUB.jpg';
    file_put_contents($path, $ebook->cover());

    expect($ebook->cover())->toBeString();
    expect(file_exists($path))->toBeTrue();
    expect($path)->toBeReadableFile();
});
