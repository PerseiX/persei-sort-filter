<?php
declare(strict_types=1);

namespace SortAndFilterBundle\Documentation;

use Nelmio\ApiDocBundle\Extractor\HandlerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use SortAndFilterBundle\Annotation\Sort;
use Symfony\Component\Routing\Route;

/**
 * Class SortAnnotationHandler
 * @package SortAndFilterBundle
 */
class SortAnnotationHandler implements HandlerInterface
{
	/**
	 * @param ApiDoc            $annotation
	 * @param array             $annotations
	 * @param Route             $route
	 * @param \ReflectionMethod $method
	 */
	public function handle(ApiDoc $annotation, array $annotations, Route $route, \ReflectionMethod $method)
	{
		foreach ($annotations as $annotationElement) {
			foreach ($annotations as $anno) {
				if (true === $anno instanceof Sort) {
					foreach ($anno->getAvailableField() as $field) {
						if ($annotationElement instanceof Sort) {
							$annotation->addParameter('sortBy[' . $field . ']', [
								"dataType"    => "array",
								"required"    => false,
								"description" => "ASC|DESC",
							]);
						}
					}
				}
			}
		}
	}
}