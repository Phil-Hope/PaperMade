<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="books")
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 */
class Books
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\ChangeLog")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="book_title", type="string", length=255)
     */
    private $BookTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="original_title", type="string", length=255)
     */
    private $OriginalTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="yearof_publication", type="integer", length=4)
     */
    private $YearofPublication;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=30)
     */
    private $Genre;

    /**
     * @var integer
     *
     * @ORM\Column(name="millions_sold", type="integer", length=10)
     */
    private $MillionsSold;

    /**
     * @var string
     *
     * @ORM\Column(name="language_written", type="string", length=30)
     */
    private $LanguageWritten;

    /**
     * @var string
     *
     * @ORM\Column(name="cover_image_path", type="string", length=255)
     */
    private $coverImagePath;


    /**
     *
     * @ORM\Column(name="plot", type="text")
     */
    private $Plot;

    /**
     *
     * @ORM\Column(name="plot_source", type="string", length=255)
     */
    private $PlotSource;

    /**
     * @ORM\Column(name="author_id", type="integer")
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;


    public function getId()
    {
        return $this->id;
    }

    public function getBookTitle()
    {
        return $this->BookTitle;
    }

    public function setBookTitle($BookTitle)
    {
        $this->BookTitle = $BookTitle;
        return $this;
    }

    public function getOriginalTitle()
    {
        return $this->OriginalTitle;
    }

    public function setOriginalTitle($OriginalTitle)
    {
        $this->OriginalTitle = $OriginalTitle;
        return $this;
    }

    public function getYearofPublication()
    {
        return $this->YearofPublication;
    }

    public function setYearofPublication($YearofPublication)
    {
        $this->YearofPublication = $YearofPublication;
        return $this;
    }

    public function getGenre()
    {
        return $this->Genre;
    }

    public function setGenre($Genre)
    {
        $this->Genre = $Genre;
        return $this;
    }

    public function getMillionsSold()
    {
        return $this->MillionsSold;
    }

    public function setMillionsSold($MillionsSold)
    {
        $this->MillionsSold = $MillionsSold;
        return $this;
    }

    public function getLanguageWritten()
    {
        return $this->LanguageWritten;
    }


    public function setLanguageWritten($LanguageWritten)
    {
        $this->LanguageWritten = $LanguageWritten;
        return $this;
    }


    public function getCoverImagePath()
    {
        return $this->coverImagePath;
    }


    public function setCoverImagePath($coverImagePath)
    {
        $this->coverImagePath = $coverImagePath;
        return $this;
    }


    public function getPlot()
    {
        return $this->Plot;
    }

    public function setPlot($Plot)
    {
        $this->Plot = $Plot;
        return $this;
    }

    public function getPlotSource()
    {
        return $this->PlotSource;
    }

    public function setPlotSource($PlotSource)
    {
        $this->PlotSource = $PlotSource;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }





}
