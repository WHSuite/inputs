#Input Helper

Input helper package for dealing with POST / GET / FILE vars.

##Setup

To setup place the following code somewhere in your system start up. (For WHSuite this will be app/bootstrap.php).

```
\Whsuite\Inputs\Inputs::init();
```
As default it will clean POST and GET variables from XSS bad things. You can turn this off by pass a boolean value of `false` in the 'init' function call.

##Usage

There are three other classes which interface with the Inputs class to make life easier.

- \Whsuite\Inputs\Post
- \Whsuite\Inputs\Get
- \Whsuite\Inputs\Files

Each of these classes have get / set functions. Access is via dot notation.

```\Whsuite\Inputs\Post::get('data.Invoice.InvoiceItems.0.amount');```

This would retrieve

```$_POST['data']['Invoice']['InvoiceItems']['0']['amount'];```

You can then set data to it as well.

```\Whsuite\Inputs\Post::set('data.Invoice.InvoiceItems.0.amount', 'foobar');```

Just swap Post out for any of the other classes.

```\Whsuite\Inputs\Get::get();```
```\Whsuite\Inputs\Get::set();```

```\Whsuite\Inputs\Files::get();```
```\Whsuite\Inputs\Files::set();```

Happy Inputting.