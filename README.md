## Panier

### Getting it running
1. `git clone`
2. `cd panier && docker compose up --build`

The database should be automatically initialized, 
and no dependencies other than Docker should be necessary

### Some notes
1. Some of these unit tests are bogus and the code is messy.
Just an unfortunate reality of having to go fast. I would have made
proper models, but using `php bin/console make:xxxx` felt against the spirit
of the assignment, so I did everything by hand.

2. Integration tests are excluded from the phpunit test suite because they
cause a SIGINT fault when using Github Actions (???). I didn't have time 
to fix this unfortunately, but they do work locally. Just remove the exclusion
directive from the xml file and run `php bin/phpunit` from the php docker
container and it should work fine.

3. I think I misunderstood what you wanted `setValue()` to mean! I used it to persist
the "values" in the cart, not change the price! My bad!

4. Didn't finish! Started getting a lot of funny buffer overflows in the last hour
or so, because I was going fast.
```bash
Testing 
........
Fatal error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 262144 bytes) in /var/www/src/Repository/InMemoryStorage.php on line 46

Fatal error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 262144 bytes) in Unknown on line 0
```

Couldn't fix it fast enough! Sorry!