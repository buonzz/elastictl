Elastictl
=========

Command Line Client for Managing ElasticSearch Indices.


## Requirements

* PHP 5.4 or later
* Memcached Server
* ElasticSearch


Features
--------

* Easily List all Indices
* Perform Global Search


## Usage

Show information about the cluster

```
elastictl cluster:info
```

List all indices
```
elastictl indices:list
```

Sort indices by size
```
bin/elastictl indices:list --sort_by=size
```

Sort indices by document count
```
bin/elastictl indices:list --sort_by=documents
```

Sort indices by document name
```
bin/elastictl indices:list --sort_by=name
```

Sort indices by health
```
bin/elastictl indices:list --sort_by=health
```

set the output table styling (valid values are compact, default, borderless)

```
bin/elastictl indices:list --style=compact
```

show hidden indices (indices that starts with period, often used by Kibana/Marvel for internal purposes)
```
bin/elastictl indices:list --exclude_hidden=no
```

filter indices coming from a certain namespace
```
bin/elastictl indices:list --namespace=domain-logs
```
the above will only show indices on which the name starts with "domain-logs". So if you have multiple indices partitioned by date, all those will show up. For example:

```
domain-logs-2017.01
domain-logs-2017.02
domain-logs-2017.03
domain-logs-2017.04
```