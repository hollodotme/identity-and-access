# Identity and Access

This is a PHP7 implementation of the identity and access management domain, described in @VaughnVernon book ["Implementing Domain-Driven Design"](http://amzn.to/28MAGRi).

The implementation extends the original domain with 

* applications, so a user of a tenant can have different roles in different applications.
* event sourcing based on a MySql event store
* CQRS with read model projection to a [redis](http://redis.io) database



