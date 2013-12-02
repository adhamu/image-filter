<?php

	Class GDFilters {

		public $img;
		private $img_path;
		private $type;
		private $extension;

		public function __construct($img_path, $type) {

			$this->img_path = $img_path;
			$this->type = $type;

			$tmpEx = strtolower($img_path);
			$tmpEx = explode(".", $tmpEx);
			$tmpEx = end($tmpEx);
			$this->extension = $tmpEx;

			$this->ApplyFilter();

		}

		private function ApplyFilter() {

			$this->img = NULL;

			if($this->extension == "jpg" || $this->extension == "jpeg") {

			    $this->img = @imagecreatefromjpeg($this->img_path)
			        or die("Cannot create new JPEG image");

			} else if($this->extension == "png") {

			    $this->img = @imagecreatefrompng($this->img_path)
			        or die("Cannot create new PNG image");

			} else if($this->extension == "gif") {

			    $this->img = @imagecreatefromgif($this->img_path)
			        or die("Cannot create new GIF image");

			}

			if($this->img) {

				switch($this->type) {
					case "bw":
						imagefilter($this->img, IMG_FILTER_GRAYSCALE);
						break;
					case "negative":
						imagefilter($this->img, IMG_FILTER_NEGATE);
						break;
					case "sepia":
						imagefilter($this->img, IMG_FILTER_GRAYSCALE);
						imagefilter($this->img, IMG_FILTER_COLORIZE, 100, 50, 0);
						break;
					case "emboss":
						imagefilter($this->img, IMG_FILTER_EMBOSS);
						break;
					case "gaussian":
						imagefilter($this->img, IMG_FILTER_GAUSSIAN_BLUR);
						break;
					case "blur":
						imagefilter($this->img, IMG_FILTER_SELECTIVE_BLUR);
						break;

				}

			}

		}

		public function getImg() {
			header("Content-type: image/jpeg");
	    	imagejpeg($this->img, NULL, 100);
		}

	}

?>