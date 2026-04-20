import { Plugin } from 'vite';
import { FilterPattern } from '@rollup/pluginutils';
import { InputType, ZlibOptions, BrotliOptions, ZstdOptions } from 'zlib';

type CoreAlgorithm = 'gzip' | 'brotliCompress' | 'deflate' | 'deflateRaw' | 'zstandard';
type AliasAlgorithm = 'gz' | 'br' | 'brotli' | 'zstd';
type Algorithm = CoreAlgorithm | AliasAlgorithm;
interface UserCompressionOptions {
    [key: string]: any;
}
type InferDefault<T> = T extends infer K ? K : UserCompressionOptions;
type CompressionOptions<T> = InferDefault<T>;
interface FileNameFunctionMetadata {
    algorithm: CoreAlgorithm | AlgorithmFunction<UserCompressionOptions>;
    options: UserCompressionOptions;
}
type LogLevel = 'info' | 'silent';
type ArtifactsFunction = () => Array<{
    src: string;
    replace?: (dest: string, fileName: string) => string;
}>;
type AlgorithmFunction<T extends UserCompressionOptions> = (buf: InputType, options: T) => Promise<Buffer>;
interface SchedulerOptions {
    /** Max number of high-memory compression operations running simultaneously. Default: 1 */
    limit?: number;
    /** Determine whether an algorithm + options combination is "high memory".
     *  When returns true, the operation will be guarded by the semaphore.
     *  Default: zstd level >= 20 or brotli quality >= 10 */
    isHighMemory?: (algorithm: CoreAlgorithm | AlgorithmFunction<UserCompressionOptions>, options: UserCompressionOptions) => boolean;
}
interface BaseCompressionPluginOptions {
    include?: FilterPattern;
    exclude?: FilterPattern;
    threshold?: number;
    filename?: string | ((id: string, metadata: FileNameFunctionMetadata) => string);
    deleteOriginalAssets?: boolean;
    skipIfLargerOrEqual?: boolean;
    logLevel?: LogLevel;
    scheduler?: SchedulerOptions;
    artifacts?: ArtifactsFunction;
}
interface AlgorithmToZlib {
    gz: ZlibOptions;
    gzip: ZlibOptions;
    brotliCompress: BrotliOptions;
    brotli: BrotliOptions;
    br: BrotliOptions;
    deflate: ZlibOptions;
    deflateRaw: ZlibOptions;
    zstd: ZstdOptions;
    zstandard: ZstdOptions;
}
type defineAliasAlgorithmResult<T extends UserCompressionOptions = UserCompressionOptions> = readonly [
    'gz',
    ZlibOptions
] | readonly [
    'br' | 'brotli',
    BrotliOptions
] | readonly [
    'zstd',
    ZstdOptions
] | readonly [
    AlgorithmFunction<T>,
    T
];
type DefineAlgorithmResult<T extends UserCompressionOptions = UserCompressionOptions> = readonly [
    'gzip' | 'deflate' | 'deflateRaw',
    ZlibOptions
] | readonly [
    'brotliCompress',
    BrotliOptions
] | readonly [
    'zstandard',
    ZstdOptions
] | readonly [
    AlgorithmFunction<T>,
    T
];
type Algorithms = (Algorithm | DefineAlgorithmResult | defineAliasAlgorithmResult)[];
interface ViteCompressionPluginOption extends BaseCompressionPluginOptions {
    algorithms?: Algorithms;
}
interface ViteTarballPluginOptions {
    dest?: string;
}

interface CompressionPluginAPI {
    staticOutputs: Set<string>;
    done: Promise<void>;
}
declare function tarball(opts?: ViteTarballPluginOptions): Plugin;
declare function compression(opts?: ViteCompressionPluginOption): Plugin;
declare namespace compression {
    var getPluginAPI: (plugins: readonly Plugin[]) => CompressionPluginAPI | undefined;
}
declare function defineAlgorithm<T extends Algorithm | UserCompressionOptions | AlgorithmFunction<UserCompressionOptions>>(algorithm: T extends Algorithm | AlgorithmFunction<UserCompressionOptions> ? T : AlgorithmFunction<Exclude<T, string>>, options?: T extends Algorithm ? AlgorithmToZlib[T] : T extends AlgorithmFunction<UserCompressionOptions> ? UserCompressionOptions : T): DefineAlgorithmResult<T extends Algorithm | AlgorithmFunction<UserCompressionOptions> ? UserCompressionOptions : T>;

export { compression, compression as default, defineAlgorithm, tarball };
export type { Algorithm, CompressionOptions, ViteCompressionPluginOption, ViteTarballPluginOptions };
