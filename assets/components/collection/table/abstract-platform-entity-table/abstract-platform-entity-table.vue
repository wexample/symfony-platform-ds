<script>
import AbstractEntityTable from '@wexample/symfony-design-system/components/collection/table/abstract-entity-table/abstract-entity-table.vue';
import AbstractOverlayPageManager from '@wexample/symfony-design-system/js/Class/AbstractOverlayPageManager';

// What every table of a management application shares: the whole page under
// a sticky header, searched, counted, paged by fifty; and read again once a
// modal closes over it, for a row that modal created or changed. A table
// gives its entity, its columns, its sort and its search placeholder; Vue
// merges its `data()` over this one.
export default {
  extends: AbstractEntityTable,

  data() {
    return {
      fill: true,
      sticky: true,
      searchable: true,
      showCount: true,
      pageLength: 50
    };
  },

  methods: {
    getCollectionRefreshEvents() {
      return [AbstractOverlayPageManager.EVENT_CLOSED];
    }
  }
};
</script>
