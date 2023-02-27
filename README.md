## What is Blog Bridge?

Blog Bridge is a simple online publishing platform (something like medium) with membership options. The publishing platform allows a user to create blog posts that includes a <b>title</b> and a <b>description</b>. A user can choose their own membership package from the membersip option and make the payment process via stripe payment system. The `core` folder of the project contains the frontend design, API Endpoints and the environment variables.

## Key Features

There are two types of membership plans that a user can choose. As a user, he/she can upgrade or downgrade their membership plan based on their current membership plan status. The types of plans are shown here:

```sh
    "Membership Plan": [
      {
        "id": 0,
        "name": "Free"
      },
      {
        "id": 1,
        "name": "Premium"
      }
    ]
```

### Free Plan

* Free members will be able to create 2 posts (maximum) daily.

* Can edit or update their own posts.

* Can upgrade to premium plan if he/she wills.

### Premium Plan

* Premium members will be able to create unlimited posts daily.

* Can edit or update their own posts.

* Can schedule their posts and the posts will be automatically published at their scheduled time. <i>(task still ongoing)</i>

* Can downgrade to free plan, but will lose all the premium plan package priviledges.