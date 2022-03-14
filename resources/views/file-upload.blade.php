<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laravel File Upload</title>
</head>
<body>
<div class="grid place-items-center h-screen">
  <div>
  <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
        <h1 class="text-center mb-5 text-3xl">Upload File in Laravel</h1>
        @csrf
        @if ($message = Session::get('success'))
            <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <label class="block">
            <span class="sr-only">Choose your file</span>
            <input name="file" type="file" class="block w-full text-sm text-slate-500
      file:mr-4 file:py-2 file:px-4
      file:rounded-full file:border-0
      file:text-sm file:font-semibold
      file:bg-violet-50 file:text-violet-700
      hover:file:bg-violet-100
      transition-all
    "/>
        </label>
        <button type="submit" name="submit"
                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-violet-600 text-white hover:bg-violet-800 block w-full mt-4 transition-all">
            Upload Files
        </button>
    </form>
    <ul class="mt-5">
      @foreach ($files as $file)
          <li><a class="cursor-pointer text-violet-500 hover:text-violet-800 translate-all" href="{{ route('fileDownload', $file->id) }}">{{ $file->name }}</a></li>
      @endforeach
  </ul>
  </div>
</div>
</body>
</html>
