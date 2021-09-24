---
name: Remove a WordPress post from search
about: How to remove a post (post/page) from from the Azure search results that was
  deleted before it search was activated in June 2019
title: Remove post from search [`post id and site slug`]
labels: bug
assignees: suzannezc

---

## Identify the post_id, site slug

- [ ] in search, hover over the wrong search result to get the post_id (id=XXXX)

## Update or add a record to Azure Search to remove it from display

- [ ] https://portal.azure.com/
- [ ] Go to wrdsb-lamson (Azure cosmos db) > Data Explorer
- [ ] Choose wp-posts
- [ ] search for the post record 
> - [ ] SELECT * FROM c WHERE c.id = "staff.wrdsb.ca_`site slug`_`post_id`"
- [ ] If the record exists, set "post_status" = "trash"
- [ ] if no record exists:
> - [ ] create a new item:
{
    "id": "staff.wrdsb.ca_`site_slug`_`post_id`",
    "post_id": `post_id`,
    "site_url": "staff.wrdsb.ca/`site slug`",
    "site_domain": "staff.wrdsb.ca",
    "site_slug": "`site slug`",
    "site_name": "`site name`",
    "site_link": "http://staff.wrdsb.ca/`site slug`",
    "site_privacy": "-1", `find in phpMyAdmin `wp_options` table `blog_public`
    "post_status": "trash",
    "visible_to": [
        "staff.wrdsb.ca:members",
        "staff.wrdsb.ca/`site slug`:members",
        "staff.wrdsb.ca/`site slug`:admins"
    ],
    "lamson_send_notification": "no",
    "lamson_do_syndication": "no",
    "lamson_syndication_targets": []
}

> - [ ] save item
- [ ] verify search results have changed (hourly on the 30)
