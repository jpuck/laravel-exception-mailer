<!doctype html><html><body>

<p>{{ class_basename(get_class($exception)) }} thrown in {{ config('app.name') }}.</p>
<p>{{ $exception->getMessage() }}</p>

<h2>User</h2>
<pre>{{ $user }}</pre>

<h2>Request</h2>
<pre>{{ $request }}</pre>

@unless(empty($validations))
    <h2>Validation</h2>
    <pre>{{ $validations }}</pre>
@endunless

<h2>Exception</h2>
<p>{{ date('c') }}</p>
<pre>{{ $exception }}</pre>

</body></html>
