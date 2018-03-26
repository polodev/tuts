<?php
use Illuminate\Support\Facade\Input;
class GenericController {
  public function export()

  {
    $data = [];
    $data['clients'] = $this->client->all();
    header('Content-disposition: attachment;filename=export.xls');
    return view('client/export', $data);
  }

  public function upload(Request $request)
  {
    $data = [];
    if ($request->isMethod('post')) {
      $this->validate($request, [
        'file' => 'mimes:jpeg,bmp,png'
      ]);
      Input::file('file')->move('images_folder which is inside public folder', 'imagename.jpg');

    }
  }
}