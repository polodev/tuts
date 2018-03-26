<?php

class ExampleText {
  ////unit test
  // public function testTitlesModelCount()
  // {
  //   $titles = new Title;
  //   $this->assertTrue(count($titles->all()) === 6, 'It should have 6 titles');
  // }
  // public function testLastTitleMustBeProfessor()
  // {
  //   $titles = new Title;
  //   $titles_array = $titles->all();
  //   $this->assertEqual('Professor', array_pop($titles_array), 'Titles last element must to be professor');
  // }
  /////functional test
  public function testNewClientForm()
  {
    $response = $this->get('/clients/new');
    $response->assertStatus(200);
  }
  public function testProfessorOption()
  {
    $response = $this->get('/clients/new');
    $this->assertContains('Professor', $response->getContent(), 'HTML should have Professor');
  }
}





