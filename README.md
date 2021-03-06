# Slack Flat Finder Bot

* Uses the Trade Me API to grab new rental properties that have been recently listed
* Checks if fibre and VDSL are available by querying Chorus
* Includes travel times to various locations
* Alerts you if the elevation of the property is below a certain threshold

We run this as a cron job every hour, and include the travel times to our offices. I wrote it late one night so I don't really care if it's too messy.

The bot can also get the elevation of the property, and depending on a certain threshold warn you if the property is potentially within a tsunami risk zone (e.g up a hill or by the sea). You should always consult your local tsunami risk zone maps for more information before making any assumptions based on the elevation.

![so pretty](http://i.imgur.com/nQe1RgQ.png "so pretty, lack of fibre is a bummer though")

## Requirements
* PHP 7.0 
* Trade Me API Key [(register an application)](https://www.trademe.co.nz/MyTradeMe/Api/RegisterNewApplication.aspx)
* Google Distance Matrix API Key [(get a key)](https://developers.google.com/maps/documentation/distance-matrix/start#get-a-key)

## Installation
* Update composer
* Update config.php with the values below
* Create a cron job to run index.php for whatever interval you want to get new notifications, for example every twelve hours
* Set that interval as a relative `strtotime` value in `$settings['new_properties_since']`, for example `now -12 hours`


## Configuration
Example: Getting new properties every hour

```
$settings = [
    'new_properties_since' => 'now -1 hour',
    'slack' => [
        'webhook_url' => '<slack webhook url>',
        'username' => '<webhook username>',
        'channel' => '<channel>',
        'link_names' => true
    ],
    'trademe' => [
        'consumer_key' => '<trade me consumer key',
        'consumer_secret' => '<trade me consumer secret>>',
        'search' => <see example config>
    ],
    'google' => [
        'key' => '<google api key for distance matrix>',
        'transport' => '<walking|driving|bicycling|transit>',
        'addresses' => [
            '<name>' => '<address>',
        ],
        'elevation' => [
            'enabled'     => true,
            'threshold'   => <elevation in meters>
        ]
    ]
];

```

Example config for Trade Me rental listings in Wellington City, with 3-4 bedrooms and a maximum rent per week of $630
```
[
    'photo_size'       => 'Large',
    'bedrooms_min'     => '3',
    'bedrooms_max'     => '4',
    'district'         => '47',
    'price_max'        => '630',
    'property_type'    => 'House,Townhouse,Apartment',
    'return_metadata'  => 'false',
    'sort_order'       => 'Default'
]
```
Reference: [http://developer.trademe.co.nz/api-reference/search-methods/rental-search/](http://developer.trademe.co.nz/api-reference/search-methods/rental-search/)
