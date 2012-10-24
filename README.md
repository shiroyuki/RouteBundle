RouteBundle
===========

Route Utility Bundle for Symfony 2.x

Usage
-----

First, import the javascript from the controller.

``` django
<script src="{{ path('shiroyuki_route_route_offline_router') }}"></script>
```

Then, instantiate the offline router.

``` javascript
var router = new OfflineRouter();
```

There is only one interface.

``` javascript
// suppose PARAMETERS is a one-dimentional associate array.
router.get(ROUTE_ID, PARAMETERS);
```

Please note that unknown parameters for a route will be ignored.