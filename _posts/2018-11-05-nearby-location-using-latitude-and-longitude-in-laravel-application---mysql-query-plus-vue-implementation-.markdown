---
title: nearby location using latitude and longitude in laravel application - mysql query plus vue implementation 
layout: post
languge: ['php', 'mysql', 'js']
tags: ['laravel', 'vue']
---



# nearby location mysql raw query in laravel controller
~~~php
 public function restaurant_by_coords () {
  $lat = request('lat');
  $lon = request('lon');
  $distance = 20; // hear distance in km
  $mysqlQuery = "SELECT
    settings.id as id,
    settings.title as title,
    settings.phone as phone,
    users.name as name,
    user_id,
    shortcode,
    address,
    logo,
    (
        6371 *
        acos(
            cos( radians( $lat ) ) *
            cos( radians( `lat` ) ) *
            cos(
                radians( `lon` ) - radians( $lon )
            ) +
            sin(radians($lat)) *
            sin(radians(`lat`))
        )
    ) `distance`
FROM
    `settings`
JOIN
  `users`
WHERE
  settings.user_id=users.id
HAVING
    `distance` < $distance
ORDER BY
    `distance`
LIMIT
    100";
  $data = DB::select($mysqlQuery);
  return response()->json($data);
 }
~~~

### Vue code 

### Vue template
~~~html
<template>
<div v-if="restaurants.length" class='row'>
  <div id="location_component">
    <div class='location_component_inner'>

      <h2 class="title">Nearby Restaurant</h2>

      <div v-for="restaurant in restaurants">
        <a class="single_restaurant" :href='`${app_url}/${restaurant.name}?comingByNearby=true`'>
          <div>
            <img :src="generateImageLink(restaurant)" alt='logo_image'/>
          </div>
          <div class='single_restaurant_content'>
            <h2>{{restaurant.title ? restaurant.title : restaurant.name}}</h2>
            <p>{{restaurant.address}}</p>
            <p>Distance from your place about <span style="font-weight: bold;">{{Math.ceil(restaurant.distance)}}km</span> </p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
</template>
~~~

#### Vue js 
~~~js
export default {
  data: function () {
    return {
      restaurants: [],
      warning: '',
      latitude: null,
      longitude: null,
    }
  },
  props: ['app_url', 'asset_domain'],
  methods: {

   getAllRestaurants: function () {
      axios.get(`${this.app_url}/restaurant/all`)
      .then(response => {
        console.log(response.data);
      })
      .catch(error => console.log('error', error))
   },
   getRestaurantByCoords: function (lat, lon) {
    axios.post(`${this.app_url}/restaurant/bycoords`, {lat, lon})
    .then((response) => {
      this.restaurants = response.data;
    })
    .catch(response => console.log(response))
   },
   generateImageLink: function (restaurant) {
     if (restaurant.logo) {
        return `${this.asset_domain}/storage/uploads/${restaurant.logo}`;
      }else {
        return `${this.app_url}/front/images/loader.png`;
      }
   },

  getGeoLocation: function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(this.showPosition);
    }else {
      this.warning = "Geolocation is not supported by this browser.";
    }
  },

  showPosition: function (position) {
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    this.latitude = lat
    this.longitude = lon
    this.getRestaurantByCoords(lat, lon);
  }

  },

  mounted: function () {
    this.getGeoLocation();
  }
}
~~~

## calling vue from laravel blade file 

~~~html
<div id='vue-app'>
  <app-location
    app_url="{{request()->root()}}"
    asset_domain="{{config('app.asset_domain')}}"
  ></app-location>
</div>
~~~
