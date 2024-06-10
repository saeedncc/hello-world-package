<?php

namespace App\OptionsResolver;

use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseOptionsResolver extends OptionsResolver
{
	
	
  private function configure(string $field, string $type, bool $isRequired)
  {
	$this->setDefined($field)->setAllowedTypes($field, $type);

    if($isRequired) {
      $this->setRequired($field);
    }
  }
  
  public function configureTitle(bool $isRequired = true): static
  {
    $this->configure("title","string",$isRequired);

    return $this;
  }

  public function configureFullname(bool $isRequired = true): static
  {
	$this->configure("fullname","string",$isRequired);

    return $this;
  }
  
  
  public function configureDriverId(bool $isRequired = true): static
  {  
	$this->configure("driver_id","integer",$isRequired);

    return $this;
  }
  
  public function configureTruckId(bool $isRequired = true): static
  {  
	$this->configure("truck_id","integer",$isRequired);

    return $this;
  }
  
   public function configureTripId(bool $isRequired = true): static
  {  
	$this->configure("trip_id","integer",$isRequired);

    return $this;
  }
  
}