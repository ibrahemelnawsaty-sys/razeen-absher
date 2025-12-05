<template>
  <div class="map-shell" style="display:flex; height:100vh;">
    <ui-sidebar :isOpen="isSidebarOpen" @toggle="isSidebarOpen = !isSidebarOpen">
      <template #title>
        <div style="display:flex;align-items:center;gap:.5rem">
          <strong>Layers & Filters</strong>
        </div>
      </template>

      <div class="mb-4">
        <ui-card>
          <template #header>
            <div style="display:flex;justify-content:space-between;align-items:center">
              <span>Search</span>
              <ui-button variant="secondary" @click="clearSearch">Clear</ui-button>
            </div>
          </template>
          <template #default>
            <input
              v-model="searchTerm"
              type="search"
              placeholder="Search by title, severity..."
              class="w-full p-2 border rounded"
            />
          </template>
        </ui-card>
      </div>

      <div class="mb-4">
        <ui-card>
          <template #header>
            <span>Layers</span>
          </template>
          <template #default>
            <div style="display:flex;flex-direction:column;gap:.5rem">
              <label style="display:flex;align-items:center;gap:.5rem">
                <input type="checkbox" v-model="layers.incidents" /> Incidents
              </label>
              <!-- future layers can be added here -->
            </div>
          </template>
        </ui-card>
      </div>

      <div>
        <ui-card>
          <template #header>
            <span>List</span>
          </template>
          <template #default>
            <div style="display:flex;flex-direction:column;gap:.5rem;max-height:40vh;overflow:auto;">
              <div v-for="f in visibleFeatures" :key="f.properties?.id" class="p-2 border rounded hover:bg-[color:var(--color-muted-bg)]" @click="focusFeature(f)">
                <div style="display:flex;justify-content:space-between;align-items:center">
                  <div>
                    <div style="font-weight:700">{{ f.properties?.title || 'Untitled' }}</div>
                    <div style="font-size:.85rem;color:rgba(0,0,0,0.6)">{{ f.properties?.severity || '' }}</div>
                  </div>
                  <ui-button variant="secondary" @click.stop="zoomToFeature(f)">Go</ui-button>
                </div>
              </div>
            </div>
          </template>
        </ui-card>
      </div>
    </ui-sidebar>

    <div style="flex:1; position:relative;">
      <div class="map-container" ref="mapEl" style="width:100%;height:100%;"></div>

      <!-- Selected feature detail card -->
      <div v-if="selectedFeature" style="position:absolute; right:1rem; bottom:1rem; width:320px;">
        <ui-card>
          <template #header>
            <div style="display:flex;justify-content:space-between;align-items:center">
              <strong>{{ selectedFeature.properties?.title || 'Detail' }}</strong>
              <ui-button variant="secondary" @click="selectedFeature = null">Close</ui-button>
            </div>
          </template>
          <template #default>
            <div>
              <div><strong>Status:</strong> {{ selectedFeature.properties?.status || '-' }}</div>
              <div><strong>Severity:</strong> {{ selectedFeature.properties?.severity || '-' }}</div>
              <div><strong>Time:</strong> {{ selectedFeature.properties?.created_at || '-' }}</div>
              <div style="margin-top:.5rem">
                <ui-button @click="zoomToFeature(selectedFeature)">Center on map</ui-button>
              </div>
            </div>
          </template>
        </ui-card>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref, computed, watch } from 'vue';
import maplibregl from 'maplibre-gl';
import 'maplibre-gl/dist/maplibre-gl.css';

export default {
  name: 'MapComponent',
  setup() {
    const mapEl = ref(null);
    let map = null;
    let subscribed = false;
    const allFeatures = ref([]); // original features from API + events
    const incidents = { type: 'FeatureCollection', features: [] };
    const isSidebarOpen = ref(true);
    const searchTerm = ref('');
    const layers = ref({ incidents: true });
    const selectedFeature = ref(null);
    let popup = null;

    const visibleFeatures = computed(() => {
      // apply layer toggle and search filter
      let list = allFeatures.value.slice();
      if (!layers.value.incidents) list = [];
      const q = searchTerm.value.trim().toLowerCase();
      if (q) {
        list = list.filter(f => {
          const t = (f.properties?.title || '').toLowerCase();
          const s = (f.properties?.severity || '').toLowerCase();
          return t.includes(q) || s.includes(q);
        });
      }
      return list;
    });

    const ensureSourceSet = () => {
      if (!map) return;
      if (!map.getSource('incidents')) {
        map.addSource('incidents', {
          type: 'geojson',
          data: incidents,
        });

        map.addLayer({
          id: 'incidents-circle',
          type: 'circle',
          source: 'incidents',
          paint: {
            'circle-radius': 6,
            'circle-color': '#ff0000',
            'circle-stroke-width': 1,
            'circle-stroke-color': '#ffffff',
          },
        });

        // click interaction
        map.on('click', 'incidents-circle', (e) => {
          const f = e.features && e.features[0];
          if (f) {
            selectedFeature.value = f;
            openPopupForFeature(f);
          }
        });

        map.on('mouseenter', 'incidents-circle', () => {
          map.getCanvas().style.cursor = 'pointer';
        });
        map.on('mouseleave', 'incidents-circle', () => {
          map.getCanvas().style.cursor = '';
        });
      } else {
        map.getSource('incidents').setData(incidents);
      }
    };

    const applyFiltersToSource = () => {
      // Sync visibleFeatures to map source
      incidents.features = visibleFeatures.value;
      if (map && map.getSource('incidents')) {
        try { map.getSource('incidents').setData(incidents); } catch (e) { /*silent*/ }
      }
    };

    const openPopupForFeature = (feature) => {
      if (!map) return;
      // cleanup old popup
      if (popup) popup.remove();
      const coords = feature.geometry?.coordinates;
      if (!coords) return;
      popup = new maplibregl.Popup({ offset: 12, closeOnClick: true })
        .setLngLat(coords)
        .setHTML(`<div class="map-popup"><strong>${feature.properties?.title || 'Item'}</strong><div style="font-size:.85rem;color:rgba(0,0,0,0.6)">${feature.properties?.severity || ''}</div></div>`)
        .addTo(map);
    };

    const focusFeature = (feature) => {
      selectedFeature.value = feature;
      zoomToFeature(feature);
      openPopupForFeature(feature);
    };

    const zoomToFeature = (feature) => {
      if (!map || !feature?.geometry?.coordinates) return;
      map.flyTo({ center: feature.geometry.coordinates, zoom: 14, speed: 0.8 });
    };

    const clearSearch = () => {
      searchTerm.value = '';
    };

    onMounted(async () => {
      const provider = import.meta.env.MAP_PROVIDER || 'maplibre';
      const tilesUrl = import.meta.env.TILES_URL || '';
      const mapboxToken = import.meta.env.MAPBOX_TOKEN || '';

      // default center [lng, lat]
      const center = [46.6753, 24.7136];

      map = new maplibregl.Map({
        container: mapEl.value,
        style: {
          version: 8,
          sources: tilesUrl ? {
            'base-tiles': {
              type: 'vector',
              tiles: [tilesUrl],
            },
          } : {},
          layers: [],
        },
        center,
        zoom: 10,
      });

      if (provider === 'mapbox' && mapboxToken) {
        map.setStyle(`https://api.mapbox.com/styles/v1/mapbox/streets-v11?access_token=${mapboxToken}`);
      }

      map.on('load', async () => {
        ensureSourceSet();

        // load initial incidents from API
        try {
          const res = await fetch('/api/incidents');
          if (res.ok) {
            const data = await res.json();
            allFeatures.value = data.features || [];
            applyFiltersToSource();
          }
        } catch (err) {
          // silent fail
        }

        // subscribe to Echo if available and not yet subscribed
        if (typeof window !== 'undefined' && window.Echo && !subscribed) {
          try {
            window.Echo.channel('incidents')
              .listen('.IncidentUpdated', (e) => {
                if (e && e.feature) {
                  const incoming = e.feature;
                  const incomingId = incoming.properties?.id;
                  const idx = allFeatures.value.findIndex(f => f.properties?.id === incomingId);
                  if (idx === -1) {
                    allFeatures.value.unshift(incoming);
                  } else {
                    allFeatures.value[idx] = incoming;
                  }
                  applyFiltersToSource();
                }
              });
            subscribed = true;
          } catch (err) {
            // silent
          }
        }
      });
    });

    watch([() => layers.value.incidents, searchTerm], () => {
      applyFiltersToSource();
    });

    onBeforeUnmount(() => {
      // unsubscribe Echo channel if used
      if (typeof window !== 'undefined' && window.Echo && subscribed) {
        try {
          window.Echo.leaveChannel('incidents');
        } catch (err) { /* ignore */ }
      }

      // cleanup popup & map
      if (popup) {
        try { popup.remove(); } catch (e) { /* ignore */ }
        popup = null;
      }

      if (map) {
        try {
          if (map.getLayer('incidents-circle')) map.removeLayer('incidents-circle');
          if (map.getSource('incidents')) map.removeSource('incidents');
        } catch (e) { /* ignore */ }
        map.remove();
        map = null;
      }
    });

    return {
      mapEl,
      isSidebarOpen,
      searchTerm,
      layers,
      selectedFeature,
      visibleFeatures,
      focusFeature,
      zoomToFeature,
      clearSearch,
    };
  },
};
</script>

<style scoped>
.map-container {
  border-radius: 6px;
  overflow: hidden;
  background: var(--color-secondary-bg, #fff);
  color: var(--color-text, #000);
  box-shadow: 0 1px 6px rgba(0,0,0,0.08);
}

/* minor responsive tweak for sidebar */
@media (max-width: 900px) {
  .sidebar { width: 100%; position: absolute; z-index: 30; }
}
</style>
